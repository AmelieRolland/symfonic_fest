<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\MailToUserRegisteredEvent;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Services\Mailing\RegistrationConfirmed;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]

    // private $userRepository;
    // public function __construct(UserRepository $userRepository)
    // {
    //     $this->userRepository = $userRepository;
    // }
    public function register(Request $request, EntityManagerInterface $em, EventDispatcherInterface $eventDispatcher, UserRepository $userRepo): Response
    {
        $user = new User();
        $role[] = 'ROLE_USER';
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $existingUser = $userRepo->findOneByEmail($user->getEmail());
            if ($existingUser) {
                $this->addFlash('error', 'Un compte a déjà été créé avec cet email! :(');
                return $this->redirectToRoute('app_registration');
            }
           
            $password = $form->get('password')->getData();
            
            $user->setPassword($password);
            $user->setRoles($role);

            $em->persist($user);


            $em->flush();

            $eventDispatcher->dispatch(
                new MailToUserRegisteredEvent($user),
                MailToUserRegisteredEvent::NAME
            );
            return $this->redirectToRoute('app_index');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
