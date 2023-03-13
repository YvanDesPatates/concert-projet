<?php

namespace App\DataFixtures;

use App\Entity\MusicStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MusicStyleFixture extends Fixture
{
    const ROCK = 'rock';
    const POP = 'pop';
    const RAP = 'rap';

    public function load(ObjectManager $manager): void
    {
         $rock = new MusicStyle();
         $rock->setName('rock');
         $manager->persist($rock);

         $pop = new MusicStyle();
         $pop->setName('pop');
         $manager->persist($pop);

         $rap = new MusicStyle();
         $rap->setName('rap');
         $manager->persist($rap);

        $manager->flush();

        $this->addReference(self::POP, $pop);
        $this->addReference(self::ROCK, $rock);
        $this->addReference(self::RAP, $rap);
    }
}
