<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Brand;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Je crée plusieurs marques
        $brand1 = new Brand();
        $brand1->setName('Adidas');

        $brand2 = new Brand();
        $brand2->setName('Nike');

        $brand3 = new Brand();
        $brand3->setName('Puma');

        $brand4 = new Brand();
        $brand4->setName('Carhartt');

        //j'enregistre les modifications dans la bdd
        $manager->flush();
    }
}
