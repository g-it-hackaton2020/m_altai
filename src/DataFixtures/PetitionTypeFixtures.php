<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\PetitionType;

class PetitionTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $individual = new PetitionType();
        $individual->setName('Индивидуальное');
        $individual->setCodeType(1);

        $manager->persist($individual);

        $collective = new PetitionType();
        $collective->setName('Коллективное');
        $collective->setCodeType(2);
        $manager->persist($collective);

        $manager->flush();
    }
}
