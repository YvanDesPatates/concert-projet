<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\MusicStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArtistFixture extends Fixture implements DependentFixtureInterface
{
    const POMME = 'Pomme';
    const ALPHA = 'Alpha Wann';
    const NEKFEU = 'Nekfeu';
    const THEPOLICE = 'The Police';

    public function load(ObjectManager $manager): void
    {
        $pomme = new Artist();
        $pomme->setName(self::POMME);
        $pomme->setDescription("Pomme est une artiste néo futuriste aux inspiration backstime néo-anthracite. Elle fait partie de la scène pop française et adore le kiwi.");
        $pomme->addMusicStyle($this->getReference(MusicStyleFixture::POP));
        $manager->persist($pomme);

        $alpha = new Artist();
        $alpha->setName(self::ALPHA);
        $alpha->setDescription("Alpha la pointure, Alpha le sniper. Considéré comme LE maître du rap français par ses pairs, il tue le beat comme personne #philyPhlingo.");
        $alpha->addMusicStyle($this->getReference(MusicStyleFixture::RAP));
        $manager->persist($alpha);

        $nekfeu = new Artist();
        $nekfeu->setName(self::NEKFEU);
        $nekfeu->setDescription("Nek le fenek, grand homme au coeur sensible, il se livre dans ses textes et se texte dans ses livres. Adulés par les adolescents, il est l'étoile montante du rap français.");
        $nekfeu->addMusicStyle($this->getReference(MusicStyleFixture::RAP));
        $manager->persist($nekfeu);

        $police = new Artist();
        $police->setName(self::THEPOLICE);
        $police->setDescription("The Police, bon on va pas se mentir c'est une rediffusion d'un ancien concert en hologramme parce qu'ils sont plus en état la. Mais c'est bien quand meme hein.");
        $police->addMusicStyle($this->getReference(MusicStyleFixture::ROCK));
        $manager->persist($police);

        $manager->flush();

        $this->addReference(self::THEPOLICE, $police);
        $this->addReference(self::ALPHA, $alpha);
        $this->addReference(self::POMME, $pomme);
        $this->addReference(self::NEKFEU, $nekfeu);
    }


    public function getDependencies()
    {
        return [
            MusicStyleFixture::class
        ];
    }
}
