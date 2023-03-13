<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    const Admin = 'admin';
    const USER2 = "user2";
    const USER3 = "user3";
    const USER4 = "user4";

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setFirstname('Jeff');
        $admin->setLastName('élesite');
        $admin->setAdresse('200 rue du coliché');
        $admin->setEmail("admin@admin.admin");
        $admin->setPassword("$2y$13$1ELmXag6JyiakCgVQxBcBeImZMa4Ley/grxK7xQKbZinBXTXQnlXy"); //superadmin
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $user2 = new User();
        $user2->setFirstname('Jean');
        $user2->setLastName('Jean');
        $user2->setAdresse('35 rue du damier');
        $user2->setEmail("JeanJean@yahoo.fr");
        $user2->setPassword('$2y$13$bKVvG3P66.2JAUdDPWOgOumhXL5d5r4.PRsdk84QcOcnbWBW2AcdS'); //jeanjean
        $user2->addArtistsLiked($this->getReference(ArtistFixture::NEKFEU));$manager->persist($user2);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setFirstname('Azrael');
        $user3->setLastName('Vache');
        $user3->setAdresse('12 rue de la prairie');
        $user3->setEmail("AzraVache@yahoo.fr");
        $user3->setPassword('$2y$13$BEVcEEIeDYSEp5LGMHqTpem3qLdQK/4kRh8ETD6v44j5Q60aDONui'); //azraelvache
        $user3->addArtistsLiked($this->getReference(ArtistFixture::NEKFEU));
        $user3->addArtistsLiked($this->getReference(ArtistFixture::POMME));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setFirstname('Samael');
        $user4->setLastName('Marcassin');
        $user4->setAdresse('25 rue de la truffe');
        $user4->setEmail("Samarcassin@yahoo.fr");
        $user4->setPassword("$2y$13$3z04JNvcSSUJ0eQMkA.pYe6B4oEN5Kc0/a11VOTInFaHlhBl540iy"); //samaelmarcassin
        $user4->addArtistsLiked($this->getReference(ArtistFixture::ALPHA));
        $user4->addArtistsLiked($this->getReference(ArtistFixture::THEPOLICE));
        $manager->persist($user4);

        $manager->flush();

        $this->addReference(self::Admin, $admin);
        $this->addReference(self::USER2, $user2);
        $this->addReference(self::USER3, $user3);
        $this->addReference(self::USER4, $user4);

    }



    public function getDependencies()
    {
        return [
            ArtistFixture::class
        ];
    }
}
