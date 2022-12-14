<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture
{

        // =============================================================== //
        // ====================   PROPRIETES   =========================== //
        // =============================================================== //

        public const ROMAN_POLICIER = "roman policier";
        public const ROMAN = "roman";
        public const BANDE_DESSINEE = "bande dessinée";
        public const LIVRE_D_ART = "livre d'art";
        public const CUISINE = "cuisine";
        public const SCIENCE_FICTION = "science fiction";
    
        // =============================================================== //
        // =====================    METHODES    ========================== //
        // =============================================================== //
    public function load(ObjectManager $manager): void
    {
        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Roman policier');
        $manager->persist($bookCategory);
        $this->setReference(self::ROMAN_POLICIER, $bookCategory);

        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Roman');
        $manager->persist($bookCategory);
        $this->setReference(self::ROMAN, $bookCategory);

        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Bande dessinée');
        $manager->persist($bookCategory);
        $this->setReference(self::BANDE_DESSINEE, $bookCategory);

        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Livre d\'art');
        $manager->persist($bookCategory);
        $this->setReference(self::LIVRE_D_ART, $bookCategory);

        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Science fiction');
        $manager->persist($bookCategory);
        $this->setReference(self::SCIENCE_FICTION, $bookCategory);

        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Cuisine');
        $manager->persist($bookCategory);
        $this->setReference(self::CUISINE, $bookCategory);

        $manager->flush();
    }
}
