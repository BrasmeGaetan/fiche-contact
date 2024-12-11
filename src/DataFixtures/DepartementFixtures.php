<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $departements = ['Direction', 'RH', 'Com', 'Dev'];

        foreach ($departements as $nom) {
            $departement = new Departement();
            $departement->setNom($nom);
            $manager->persist($departement);
        }

        $manager->flush();
    }
}
