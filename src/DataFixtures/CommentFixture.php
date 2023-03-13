<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixture extends Fixture implements DependentFixtureInterface
{
    const com1 = 'com1';
    const com2 = 'com2';
    const com3 = 'com3';

    public function load(ObjectManager $manager): void
    {
        $com1 = new Comment();
        $com1->setAuthor($this->getReference(UserFixture::USER2));
        $com1->setConcert($this->getReference(ConcertFixture::Concert1));
        $com1->setComment("CT fou G adorer !!!!");
        $manager->persist($com1);

        $com2 = new Comment();
        $com2->setAuthor($this->getReference(UserFixture::USER3));
        $com2->setConcert($this->getReference(ConcertFixture::Concert2));
        $com2->setComment("WAAAAHHHH (✯◡✯)	c'était le meilleur concert de ma vie, de la pure magie (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧");
        $manager->persist($com2);

        $com3 = new Comment();
        $com3->setAuthor($this->getReference(UserFixture::USER4));
        $com3->setConcert($this->getReference(ConcertFixture::Concert2));
        $com3->setComment("tout simplement déléctable. Entre rêve et douce réalitée, je n'aurais osé imaginer mieux que cette experience à la fois narrative, musical et sensorielle. Je n'ai qu'une chose à dire pour conclure, chapeau l'artiste.");
        $manager->persist($com3);

        $manager->flush();

        $this->addReference(self::com1, $com1);
        $this->addReference(self::com2, $com2);
        $this->addReference(self::com3, $com3);
    }


    public function getDependencies()
    {
        return [
            UserFixture::class,
            ConcertFixture::class
        ];
    }
}
