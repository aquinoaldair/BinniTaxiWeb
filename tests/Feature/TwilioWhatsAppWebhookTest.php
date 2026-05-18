<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Services\Twilio\TwilioWhatsAppMessenger;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TwilioWhatsAppWebhookTest extends TestCase
{
    public function test_it_logs_incoming_whatsapp_messages_and_replies_to_sender(): void
    {
        $messenger = new class () extends TwilioWhatsAppMessenger {
            /** @var list<array{to: string, body: string}> */
            public array $sentMessages = [];

            public function sendMessage(string $to, string $body): string
            {
                $this->sentMessages[] = compact('to', 'body');

                return 'SM_REPLY_123';
            }
        };

        $this->app->instance(TwilioWhatsAppMessenger::class, $messenger);

        Log::shouldReceive('info')
            ->once()
            ->with('Incoming Twilio WhatsApp message', [
                'from' => 'whatsapp:+5215555555555',
                'to' => 'whatsapp:+14155238886',
                'body' => 'Necesito un taxi',
                'message_sid' => 'SM123456789',
                'payload' => [
                    'From' => 'whatsapp:+5215555555555',
                    'To' => 'whatsapp:+14155238886',
                    'Body' => 'Necesito un taxi',
                    'MessageSid' => 'SM123456789',
                ],
            ]);
        Log::shouldReceive('info')
            ->once()
            ->with('Outgoing Twilio WhatsApp reply sent', [
                'to' => 'whatsapp:+5215555555555',
                'body' => 'Recibí tu mensaje: Necesito un taxi',
                'message_sid' => 'SM_REPLY_123',
            ]);

        $response = $this->post('/webhooks/twilio/whatsapp', [
            'From' => 'whatsapp:+5215555555555',
            'To' => 'whatsapp:+14155238886',
            'Body' => 'Necesito un taxi',
            'MessageSid' => 'SM123456789',
        ]);

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'text/xml; charset=UTF-8')
            ->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false)
            ->assertSee('<Response></Response>', false);

        $this->assertSame([
            [
                'to' => 'whatsapp:+5215555555555',
                'body' => 'Recibí tu mensaje: Necesito un taxi',
            ],
        ], $messenger->sentMessages);
    }

    public function test_it_does_not_reply_when_sender_is_missing(): void
    {
        $messenger = new class () extends TwilioWhatsAppMessenger {
            /** @var list<array{to: string, body: string}> */
            public array $sentMessages = [];

            public function sendMessage(string $to, string $body): string
            {
                $this->sentMessages[] = compact('to', 'body');

                return 'SM_REPLY_123';
            }
        };

        $this->app->instance(TwilioWhatsAppMessenger::class, $messenger);

        Log::shouldReceive('info')->once();

        $response = $this->post('/webhooks/twilio/whatsapp', [
            'Body' => 'Necesito un taxi',
        ]);

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'text/xml; charset=UTF-8');

        $this->assertSame([], $messenger->sentMessages);
    }
}
