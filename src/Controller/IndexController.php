<?php

namespace App\Controller;

use App\Entity\BandRegister;
use App\Entity\Days;
use App\Entity\ProgDay;
use App\Repository\DaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
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

    public function bandInfo(BandRegister $bandRegister, EntityManagerInterface $em): Response
    {
        $progDayRepository = $em->getRepository(ProgDay::class);
        $progDay = $progDayRepository->findOneBy(['bandRegister' => $bandRegister]);

        return $this->render('index/band.html.twig', [
            'bandRegister' => $bandRegister,
            'progDay' => $progDay

        ]);
    }
}
