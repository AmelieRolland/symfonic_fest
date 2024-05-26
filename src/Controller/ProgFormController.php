<?php

namespace App\Controller;

use App\Entity\ProgDay;
use App\Form\ProgFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProgFormController extends AbstractController
{
    #[Route('admin/progform', name: 'app_prog_form')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $prog = new ProgDay();

        $form = $this->createForm(ProgFormType::class, $prog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {   

            $band = $form->get('bandRegister')->getData();
            $day = $form->get('days')->getData();
            $scene = $form->get('scene')->getData();
            $hour = $form->get('hour')->getData();


            $prog->setDays($day);
            $prog->setHour($hour);

            $prog->setBandRegister($band);
            $prog->setScene($scene);


            $em->persist($prog);
            $em->flush();
            $this->addFlash('success', 'Nouvelle programamtion enregistrée!');
            return $this->redirectToRoute('app_prog_form');

        };

        return $this->render('/progform/index.html.twig', [
            'form' => $form,
        ]); 
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Erreur lors de l\'enregistrement :(');
            }
        }
    }




    

    

