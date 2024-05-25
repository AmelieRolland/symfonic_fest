<?php

namespace App\Controller\Admin;

use App\Entity\BandImages;
use App\Entity\BandRegister;
use App\Form\BandRegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BandRegisterController extends AbstractController
{
    #[Route('admin/bandregister', name: 'app_band_register')]
    public function new(Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {
        $bandRegister = new BandRegister();
        $form = $this->createForm(BandRegisterType::class, $bandRegister);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imgFile */
            $imgFile = $form->get('img_file_name')->getData();
            $bandImage = $form->get('bandImage')->getData();
            $bandName = $form->get('band_name')->getData();
            $bandYear = $form->get('creation_year')->getData() ;
            $bandDescription = $form->get('description')->getData();
            $musicGenre = $form->get('musicGenreId')->getData();
            $bandCountry = $form->get('country')->getData();
           
            if (!empty($bandImage)) {
                foreach ($bandImage as $image) {
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                    $safeFilename = $slugger->slug($originalFilename);
                    $newfilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                    try {
                        $image->move(
                            'uploads', $newfilename );

                        $imageBand = new BandImages();
                        $imageBand
                            ->setBand($bandRegister)
                            ->setImgName($newfilename);

                        $em->persist($imageBand);
                    } catch (FileException $e) {
                        $form->addError(new FormError("Erreur lors de l'upload"));
                    }
                }
            }

            if ($imgFile) {
               
                $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imgFile->guessExtension();

                    try {
                        $imgFile->move('uploads', $newFilename);
                        $bandRegister->setImgFileName($newFilename);
                        $bandRegister->setBandName($bandName);
                        $bandRegister->setCreationYear($bandYear);
                        $bandRegister->setDescription($bandDescription);
                        $bandRegister->setMusicGenreId($musicGenre);
                        $bandRegister->setCountry($bandCountry);
        
                        $em->persist($bandRegister);
                        $em->flush();

                        $this->addFlash('success', $bandName . ' a bien été enregistré!');

                        return $this->redirectToRoute('app_band_register', [], Response::HTTP_SEE_OTHER);

                        
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors de l\'upload :(');
                        }
                    }

                }
                return $this->render('bandregister/index.html.twig', [

                    'form' => $form,
                ]);
    }


}