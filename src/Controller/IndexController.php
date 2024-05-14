<?php

namespace App\Controller;

use App\Entity\Days;
use App\Repository\DaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(DaysRepository $daysRepository): Response
    {
        $days = $daysRepository->findAll();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'Symfonic Fest',
            'days' => $days
        ]);
    }

    #[Route('index/{id}', name: 'app_progday')]

    public function progday(Days $days): Response
    {
        return $this->render('index/progday.html.twig', [
            'days' => $days
        ]);
    }
}
