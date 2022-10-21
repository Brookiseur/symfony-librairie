<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $book = new Book();
        $book->setTitre("L'échappée Bill");
        $book->setSlug('l-echappee-bill');
        $book->setImageName('echappeebill.jpg');
        $book->setAuthor($this->getReference(AuthorFixtures::JEAN_ROBA));
        $book->setBookCategory($this->getReference(BookCategoryFixtures::BANDE_DESSINEE));
        $book->setIsActive(true);
        $manager->persist($book);

        $book = new Book();
        $book->setTitre("Royal taquin");
        $book->setSlug('royal-taquin');
        $book->setImageName('royal-taquin.jpg');
        $book->setAuthor($this->getReference(AuthorFixtures::JEAN_ROBA));
        $book->setBookCategory($this->getReference(BookCategoryFixtures::BANDE_DESSINEE));
        $book->setIsActive(true);
        $manager->persist($book);

        $book = new Book();
        $book->setTitre("Bill se tient a caro");
        $book->setSlug('bill-se-tient-a-caro');
        $book->setImageName('billsetientacaro.jpg');
        $book->setAuthor($this->getReference(AuthorFixtures::JEAN_ROBA));
        $book->setBookCategory($this->getReference(BookCategoryFixtures::BANDE_DESSINEE));
        $book->setIsActive(true);
        $manager->persist($book);

        $book = new Book();
        $book->setTitre("Les misérables");
        $book->setSlug('les-miserables');
        $book->setImageName('lesmiserables.jpg');
        $book->setAuthor($this->getReference(AuthorFixtures::VICTOR_HUGO));
        $book->setBookCategory($this->getReference(BookCategoryFixtures::ROMAN));
        $book->setIsActive(true);
        $manager->persist($book);

        $book = new Book();
        $book->setTitre("Miséricorde");
        $book->setSlug('misericorde');
        $book->setImageName('misericorde.jpg');
        $book->setAuthor($this->getReference(AuthorFixtures::JUSSI_ALDER_OLSEN));
        $book->setBookCategory($this->getReference(BookCategoryFixtures::ROMAN_POLICIER));
        $book->setIsActive(true);
        $manager->persist($book);

        $manager->flush();
    }
}
