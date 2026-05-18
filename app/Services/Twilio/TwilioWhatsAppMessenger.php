<?php

declare(strict_types=1);

namespace App\Services\Twilio;

use InvalidArgumentException;
use Twilio\Rest\Client;

class TwilioWhatsAppMessenger
{
    public function sendMessage(string $to, string $body): string
    {
        $accountSid = config('services.twilio.account_sid');
        $authToken = config('services.twilio.auth_token');
        $from = config('services.twilio.whatsapp_from');

        if (! is_string($accountSid) || $accountSid === '') {
            throw new InvalidArgumentException('Twilio account SID is not configured.');
        }

        if (! is_string($authToken) || $authToken === '') {
            throw new InvalidArgumentException('Twilio auth token is not configured.');
        }

        if (! is_string($from) || $from === '') {
            throw new InvalidArgumentException('Twilio WhatsApp sender is not configured.');
        }

        $message = (new Client($accountSid, $authToken))->messages->create($to, [
            'from' => $from,
            'body' => $body,
        ]);

        return $message->sid;
    }
}
