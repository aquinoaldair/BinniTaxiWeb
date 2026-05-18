<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Twilio\TwilioWhatsAppMessenger;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Throwable;

#[Signature('twilio:whatsapp:send {to : Recipient number, e.g. whatsapp:+5215555555555} {message : Message body}')]
#[Description('Send a WhatsApp message through Twilio')]
final class SendTwilioWhatsAppMessage extends Command
{
    public function handle(TwilioWhatsAppMessenger $messenger): int
    {
        $to = $this->normalizeWhatsAppNumber((string) $this->argument('to'));
        $message = (string) $this->argument('message');

        try {
            $messageSid = $messenger->sendMessage($to, $message);
        } catch (Throwable $exception) {
            $this->error("WhatsApp message could not be sent: {$exception->getMessage()}");

            return self::FAILURE;
        }

        $this->info("WhatsApp message sent to {$to}. SID: {$messageSid}");

        return self::SUCCESS;
    }

    private function normalizeWhatsAppNumber(string $number): string
    {
        if (str_starts_with($number, 'whatsapp:')) {
            return $number;
        }

        return "whatsapp:{$number}";
    }
}
