<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Services\Twilio\TwilioWhatsAppMessenger;
use RuntimeException;
use Tests\TestCase;

class SendTwilioWhatsAppMessageCommandTest extends TestCase
{
    public function test_it_sends_a_whatsapp_message(): void
    {
        $messenger = new class extends TwilioWhatsAppMessenger
        {
            public array $sentMessages = [];

            public function sendMessage(string $to, string $body): string
            {
                $this->sentMessages[] = compact('to', 'body');

                return 'SM_COMMAND_123';
            }
        };

        $this->app->instance(TwilioWhatsAppMessenger::class, $messenger);

        $this->artisan('twilio:whatsapp:send', [
            'to' => '+5215555555555',
            'message' => 'Mensaje de prueba',
        ])
            ->expectsOutput('WhatsApp message sent to whatsapp:+5215555555555. SID: SM_COMMAND_123')
            ->assertSuccessful();

        $this->assertSame([
            [
                'to' => 'whatsapp:+5215555555555',
                'body' => 'Mensaje de prueba',
            ],
        ], $messenger->sentMessages);
    }

    public function test_it_reports_send_failures(): void
    {
        $this->app->instance(TwilioWhatsAppMessenger::class, new class extends TwilioWhatsAppMessenger
        {
            public function sendMessage(string $to, string $body): string
            {
                throw new RuntimeException('Twilio rejected the request.');
            }
        });

        $this->artisan('twilio:whatsapp:send', [
            'to' => 'whatsapp:+5215555555555',
            'message' => 'Mensaje de prueba',
        ])
            ->expectsOutput('WhatsApp message could not be sent: Twilio rejected the request.')
            ->assertFailed();
    }
}
