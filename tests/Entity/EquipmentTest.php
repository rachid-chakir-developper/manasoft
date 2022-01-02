<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Equipment;

class EquipmentTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        
        //$routerService = self::$container->get('router');
        //$myCustomService = self::$container->get(CustomService::class);
        $equipment = new Equipment();
        $equipment->setName("Equipement ")
                ->setCategory("Catégorie de l'Equipement ")
                ->setNumber("NUM")
                ->setDescription("Déscription de l'Equipement ");

        $validator = self::$container->get('validator');

        $this->assertCount(0, $validator->validate($equipment));

    }
}
