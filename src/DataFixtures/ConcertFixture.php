<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertFixture extends Fixture implements DependentFixtureInterface
{
    const Concert1 = 'concert1';
    const Concert2 = 'concert2';
    const Concert3 = 'concert3';

    public function load(ObjectManager $manager): void
    {
         $concert1 = new Concert();
         $concert1->setName(ArtistFixture::THEPOLICE." Tour");
         $concert1->setDescription("Pour leurs 127ème tournés, The Police se représente en France ! Une représentation Holographique comme jamais vue auparavant !");
         $concert1->setDate(new \DateTime('2023-01-15 21:45:00'));
         $concert1->setConcertHall($this->getReference(ConcertHallFixture::SALLE1));
         $concert1->addArtistsPerformer($this->getReference(ArtistFixture::THEPOLICE));
         $manager->persist($concert1);

        $concert2 = new Concert();
        $concert2->setName(ArtistFixture::POMME." Tour");
        $concert2->setDescription("Prenez vite vos places pour ce concert plus dux qu'un crumble, car les billets se vendent comme des petites pommes !");
        $concert2->setDate(new \DateTime('2023-06-12 22:00:00'));
        $concert2->setConcertHall($this->getReference(ConcertHallFixture::SALLE2));
        $concert2->addArtistsPerformer($this->getReference(ArtistFixture::POMME));
        $manager->persist($concert2);

        $concert3 = new Concert();
        $concert3->setName(ArtistFixture::ALPHA." and ".ArtistFixture::NEKFEU." Tour");
        $concert3->setDescription("Un concert unique au monde, souvent rêvé mais jamais vu ! Préparez vos pogos et vos tympans pour le concert rêvé de tout les aficionados du rap FR.");
        $concert3->setDate(new \DateTime('2023-05-24 19:30:00'));
        $concert3->setConcertHall($this->getReference(ConcertHallFixture::SALLE3));
        $concert3->addArtistsPerformer($this->getReference(ArtistFixture::ALPHA));
        $concert3->addArtistsPerformer($this->getReference(ArtistFixture::NEKFEU));
        $manager->persist($concert3);

        $concert4 = new Concert();
        $concert4->setName(ArtistFixture::POMME." and ".ArtistFixture::NEKFEU." Tour");
        $concert4->setDescription("Une pomme, du feu, beaucoup de sucre. Nous sommes heureux de vous présenter le premier concert commun de Pomme et Nekfeu. Préparer vos papilles pour la meilleur pomme d'amour de votre vie !");
        $concert4->setDate(new \DateTime('2024-05-24 19:40:00'));
        $concert4->setConcertHall($this->getReference(ConcertHallFixture::SALLE3));
        $concert4->addArtistsPerformer($this->getReference(ArtistFixture::POMME));
        $concert4->addArtistsPerformer($this->getReference(ArtistFixture::NEKFEU));
        $manager->persist($concert4);

        $concert5 = new Concert();
        $concert5->setName(ArtistFixture::ALPHA." and ".ArtistFixture::NEKFEU." Tour");
        $concert5->setDescription("La première représentation avait littéralement TOUT CASSER. Après 2 ans de travaux, la salle est de nouveau prête à accueillir cet évènement exceptionnelle !");
        $concert5->setDate(new \DateTime('2025-05-24 19:50:00'));
        $concert5->setConcertHall($this->getReference(ConcertHallFixture::SALLE2));
        $concert5->addArtistsPerformer($this->getReference(ArtistFixture::ALPHA));
        $concert5->addArtistsPerformer($this->getReference(ArtistFixture::NEKFEU));
        $manager->persist($concert5);

        $concert6 = new Concert();
        $concert6->setName(ArtistFixture::THEPOLICE." Tour");
        $concert6->setDescription("La deuxième tournée de The Police dans notre salle !");
        $concert6->setDate(new \DateTime('2022-06-12 20:45:00'));
        $concert6->setConcertHall($this->getReference(ConcertHallFixture::SALLE3));
        $concert6->addArtistsPerformer($this->getReference(ArtistFixture::THEPOLICE));
        $manager->persist($concert6);

        $concert7 = new Concert();
        $concert7->setName(ArtistFixture::THEPOLICE." Tour");
        $concert7->setDescription("Pour la première fois dans votre ville, The Police en chère et en os !");
        $concert7->setDate(new \DateTime('2021-07-03 19:30:00'));
        $concert7->setConcertHall($this->getReference(ConcertHallFixture::SALLE1));
        $concert7->addArtistsPerformer($this->getReference(ArtistFixture::THEPOLICE));
        $manager->persist($concert7);

        $manager->flush();

        $this->addReference(self::Concert1, $concert1);
        $this->addReference(self::Concert2, $concert2);
        $this->addReference(self::Concert3, $concert3);
    }


    public function getDependencies()
    {
        return [
            ConcertHallFixture::class,
            ArtistFixture::class
        ];
    }
}
