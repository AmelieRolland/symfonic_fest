<?php

namespace App\Controller;

use App\Entity\BandRegister;
use App\Form\BandRegister1Type;
use App\Repository\BandRegisterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/bandregister/crud')]
class BandRegisterCrudController extends AbstractController
{
    #[Route('/', name: 'app_band_register_crud_index', methods: ['GET'])]
    public function index(BandRegisterRepository $bandRegisterRepository): Response
    {
        return $this->render('bandregistercrud/index.html.twig', [
            'band_registers' => $bandRegisterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_band_register_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bandRegister = new BandRegister();
        $form = $this->createForm(BandRegister1Type::class, $bandRegister);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bandRegister);
            $entityManager->flush();

            return $this->redirectToRoute('app_band_register_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bandregistercrud/new.html.twig', [
            'band_register' => $bandRegister,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_band_register_crud_show', methods: ['GET'])]
    public function show(BandRegister $bandRegister): Response
    {
        return $this->render('bandregistercrud/show.html.twig', [
            'band_register' => $bandRegister
        ]);
    }

    #[Route('/{id}/edit', name: 'app_band_register_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BandRegister $bandRegister, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BandRegister1Type::class, $bandRegister);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_band_register_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bandregistercrud/edit.html.twig', [
            'band_register' => $bandRegister,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_band_register_crud_delete', methods: ['POST'])]
    public function delete(Request $request, BandRegister $bandRegister, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete'.$bandRegister->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($bandRegister);


            $entityManager->flush();
        }

        return $this->redirectToRoute('app_band_register_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
