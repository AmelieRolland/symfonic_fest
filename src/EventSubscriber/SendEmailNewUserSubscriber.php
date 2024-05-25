<?php

namespace App\EventSubscriber;

use App\Event\MailToUserRegisteredEvent;
use App\Services\Mailing\RegistrationConfirmedService;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class SendEmailNewUserSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private RegistrationConfirmedService $registrationConfirmedService,
    ) 
    {}

    public function sendConfirmationEmail(MailToUserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        $this->registrationConfirmedService->sendConfirmation($user);
    }

    public function getSubscribedEvents(): array
    {
      return [
        MailToUserRegisteredEvent::NAME
      ];
    }






}