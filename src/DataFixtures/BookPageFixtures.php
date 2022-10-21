<?php

namespace App\DataFixtures;

use App\Entity\BookPage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookPageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$bookPage = new BookPage();
        //$manager->persist($bookPage);

        $manager->flush();
    }
}
