<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 5 ; $i++) { 

            $equipment = new Equipment();
            $equipment->setName("Equipement ".$i)
                    ->setCategory("Catégorie de l'Equipement ".$i)
                    ->setNumber("NUM".$i)
                    ->setDescription("Déscription de l'Equipement ".$i);
            $manager->persist($equipment);

            $manager->flush();
        }
    }
}
