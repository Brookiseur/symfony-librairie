<?php

namespace App\DataFixtures;

use App\Entity\Carousel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarouselFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $carousel = new Carousel();
        $carousel->setTag('home');
        $carousel->setImageName('elmer.jpg');
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setTag('home');
        $carousel->setImageName('mannelebretzel.jpg');
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setTag('home');
        $carousel->setImageName('voyagecerf.jpg');
        $manager->persist($carousel);

        $manager->flush();
    }
}
