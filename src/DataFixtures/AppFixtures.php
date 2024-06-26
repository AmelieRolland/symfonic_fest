<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\Days;
use App\Entity\MusicGenre;
use App\Entity\Scene;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use SplFileObject;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = new File(__DIR__ . '/files/pays.csv');

        $paysCsv = $file->openFile();
        $paysCsv->setFlags(SplFileObject::READ_CSV);
        $paysCsv->setCsvControl(",");
        $countriesnames = [];

        foreach ($paysCsv as $line) {
            if (isset($line[5])) {
                $country = new Country();
                $country->setName($line[5]);
                $manager->persist($country);
            }
        }


        $musicgenresName= ['rock', 'pop', 'jazz', 'classic', 'punk', 'metal', 'grunge', 'pop-rock', 'folk'];
        // $genres=[];

        foreach ($musicgenresName as $musicgenre){
            $genre = new MusicGenre();
            $genre->setGenreName($musicgenre);
            // $genres[] = $genre;
            $manager->persist($genre);
        }


        $sceneNames= ['Scène Emergente', 'Scène Tremplin', 'Scène Principale'];

        foreach ($sceneNames as $sceneName){
            $scene = new Scene();
            $scene->setSceneName($sceneName);
            $manager->persist($scene);
        }



        $dayNames= ['Vendredi 27 Novembre', 'Samedi 28 Novembre', 'Dimanche 29 Novembre'];

        foreach ($dayNames as $dayName){
            $day = new Days();
            $day->setDay($dayName);
            $day->setImgFileName('affiche.jpg');
            $manager->persist($day);
        }

        $admin = new User();
        $admin ->setEmail("admin@symfonic.fr");
        $admin ->setRoles(["ROLE_ADMIN"]);
        $admin ->setPassword("admin");
        $manager->persist($admin);

        

        $manager->flush();
    }
}
