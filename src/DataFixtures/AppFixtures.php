<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\MusicGenre;
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
        $genres=[];

        foreach ($musicgenresName as $musicgenre){
            $genre = new MusicGenre();
            $genre->setGenreName($musicgenre);
            $genres[] = $genre;
            $manager->persist($genre);
        }

        $manager->flush();
    }
}
