<?php

namespace App\DataFixtures;

use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TicketFixture extends Fixture implements DependentFixtureInterface
{
    const TICKET1 = 'ticket1';
    const TICKET2 = 'ticket2';
    const TICKET3 = 'ticket3';
    const TICKET4 = 'ticket4';
    const TICKET5 = 'ticket5';

    public function load(ObjectManager $manager): void
    {
        $ticket1 = new Ticket();
        $ticket1->setUser($this->getReference(UserFixture::USER2));
        $ticket1->setConcert($this->getReference(ConcertFixture::Concert1));
        $manager->persist($ticket1);

        $ticket2 = new Ticket();
        $ticket2->setUser($this->getReference(UserFixture::USER3));
        $ticket2->setConcert($this->getReference(ConcertFixture::Concert2));
        $manager->persist($ticket2);

        $ticket5 = new Ticket();
        $ticket5->setUser($this->getReference(UserFixture::USER3));
        $ticket5->setConcert($this->getReference(ConcertFixture::Concert1));
        $manager->persist($ticket5);

        $ticket3 = new Ticket();
        $ticket3->setUser($this->getReference(UserFixture::USER4));
        $ticket3->setConcert($this->getReference(ConcertFixture::Concert3));
        $manager->persist($ticket3);

        $ticket4 = new Ticket();
        $ticket4->setUser($this->getReference(UserFixture::USER4));
        $ticket4->setConcert($this->getReference(ConcertFixture::Concert2));
        $manager->persist($ticket3);

        $manager->flush();

        $this->addReference(self::TICKET1, $ticket1);
        $this->addReference(self::TICKET2, $ticket2);
        $this->addReference(self::TICKET3, $ticket3);
        $this->addReference(self::TICKET4, $ticket4);
        $this->addReference(self::TICKET5, $ticket5);
    }


    public function getDependencies()
    {
        return [
            UserFixture::class,
            ConcertFixture::class
        ];
    }
}
