<?php

namespace App\Event;

use App\Entity\User;

class MailToUserRegisteredEvent
{
    public const NAME = 'user.registered';

    public function __construct(private User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}