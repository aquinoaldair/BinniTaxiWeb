<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Twilio\TwilioWhatsAppMessenger;
use App\Services\Twilio\WhatsAppBotResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

final class TwilioWhatsAppWebhookController extends Controller
{
    public function __invoke(
        Request $request,
        WhatsAppBotResponder $responder,
        TwilioWhatsAppMessenger $messenger,
    ): Response {
        $payload = $request->all();
        $from = $request->string('From')->toString();
        $body = $request->string('Body')->toString();

        Log::info('Incoming Twilio WhatsApp message', [
            'from' => $from,
            'to' => $request->string('To')->toString(),
            'body' => $body,
            'message_sid' => $request->string('MessageSid')->toString(),
            'payload' => $payload,
        ]);

        if ($from !== '') {
            $reply = $responder->responseFor($body);
            $messageSid = $messenger->sendMessage($from, $reply);

            Log::info('Outgoing Twilio WhatsApp reply sent', [
                'to' => $from,
                'body' => $reply,
                'message_sid' => $messageSid,
            ]);
        }

        return response($this->emptyTwiml(), 200)
            ->header('Content-Type', 'text/xml');
    }

    private function emptyTwiml(): string
    {
        return '<?xml version="1.0" encoding="UTF-8"?><Response></Response>';
    }
}
