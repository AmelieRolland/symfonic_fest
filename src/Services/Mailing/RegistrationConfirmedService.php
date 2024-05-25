<?php

namespace App\Services\Mailing;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistrationConfirmedService{

    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ) {
    }

    public function sendConfirmation(User $user): void
    {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($user->getEmail())
            ->subject('Bienvenue dans l\'univers Symfonic!')
            ->html('<p>Bienvenue dans l\'univers Symfonic!</p><p>Votre compte a bien été créé.</p');

        $this->mailer->send($email);
    }

}