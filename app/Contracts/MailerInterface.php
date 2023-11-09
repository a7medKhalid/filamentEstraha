<?php

namespace App\Contracts;

interface MailerInterface
{
    public function raw(string $text, string $email, string $subject): void;
}
