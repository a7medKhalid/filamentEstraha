<?php

namespace App\Services\Mailers;

use App\Contracts\MailerInterface;
use Illuminate\Support\Facades\Mail;

class NiceMailerService implements MailerInterface
{

    public function raw(string $text, string $email, string $subject): void
    {
        Mail::raw($text, function ($message) use($email, $subject) {
            $message->to($email)->subject($subject);
        });
    }
}
