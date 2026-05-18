<?php

declare(strict_types=1);

namespace App\Services\Twilio;

final class WhatsAppBotResponder
{
    public function responseFor(string $message): string
    {
        $normalizedMessage = mb_strtolower(trim($message));

        // Add future bot intents here before falling back to the echo response.
        if ($normalizedMessage === 'hola') {
            return 'Hola 👋, soy tu bot conectado con Laravel.';
        }

        return "Recibí tu mensaje: {$message}";
    }
}
