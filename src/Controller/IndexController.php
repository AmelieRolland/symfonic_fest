<?php

namespace App\Controller;

use App\Entity\BandRegister;
use App\Entity\Days;
use App\Entity\ProgDay;
use App\Repository\DaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(DaysRepository $daysRepository): Response
    {
        $user = $this->getUser();

        $days = $daysRepository->findAll();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'Symfonic Fest',
            'user' => $user,
            'days' => $days
        ]);
    }

    #[Route('index/progday/{id}', name: 'app_progday')]

    public function progday(Days $days): Response
    {
        return $this->render('index/progday.html.twig', [
            'days' => $days,

        ]);
    }

    #[Route('band/{id}', name: 'app_band')]

    public function bandInfo(BandRegister $bandRegister): Response
    {
        return $this->render('index/band.html.twig', [
            'bandRegister' => $bandRegister,

        ]);
    }
}
