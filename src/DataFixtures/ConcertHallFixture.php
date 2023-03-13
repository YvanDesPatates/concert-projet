<?php

namespace App\DataFixtures;

use App\Entity\ConcertHall;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertHallFixture extends Fixture
{
    const SALLE1 = 'Jean La Salle';
    const SALLE2 = 'Salle Igot';
    const SALLE3 = 'Salle Tot';

    public function load(ObjectManager $manager): void
    {
         $salle1 = new ConcertHall();
         $salle1->setName(self::SALLE1);
         $salle1->setDescription('une salle rustique et brute mais pleine de charme.');
         $salle1->setSeatCapacity(0);
         $salle1->setStandingCapacity(50);
         $salle1->setRenovationStartDate(new \DateTime());
         $salle1->setRenovationEndDate(new \DateTime('2023-07-25'));
         $manager->persist($salle1);

        $salle2 = new ConcertHall();
        $salle2->setName(self::SALLE2);
        $salle2->setDescription("une salle trompeuse, mais qu'est-ce qu'on y ris !");
        $salle2->setSeatCapacity(0);
        $salle2->setStandingCapacity(100);
        $manager->persist($salle2);

        $salle3 = new ConcertHall();
        $salle3->setName(self::SALLE3);
        $salle3->setDescription("une salle périeuse... c'est le moins qu'on puisse dire !");
        $salle3->setSeatCapacity(50);
        $salle3->setStandingCapacity(50);
        $manager->persist($salle3);

        $manager->flush();

        $this->addReference(self::SALLE1, $salle1);
        $this->addReference(self::SALLE2, $salle2);
        $this->addReference(self::SALLE3, $salle3);

    }
}
