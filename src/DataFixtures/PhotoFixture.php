<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PhotoFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
         $photo1 = new Photo();
         $photo1->setName('nekfeu');
         $photo1->setAlternativeName("photo de l'artiste Nekfeu");
         $photo1->setUrl("https://cdn-s-www.leprogres.fr/images/AA55290C-1653-4EEF-81D9-E79AF63A50F3/NW_detail_M/title-1576680650.jpg");
         $photo1->addArtist($this->getReference(ArtistFixture::NEKFEU));
         $manager->persist($photo1);

        $photo2 = new Photo();
        $photo2->setName('nekfeu2');
        $photo2->setAlternativeName("photo de l'artiste Nekfeu");
        $photo2->setUrl("https://www.programme-tv.net/imgre/fit/~2~providerPerson~1c39fa5c3bbcf762.jpeg/300x300/quality/80/nekfeu.jpeg");
        $photo2->addArtist($this->getReference(ArtistFixture::NEKFEU));
        $manager->persist($photo2);

        $photo3 = new Photo();
        $photo3->setName('nekfeu3');
        $photo3->setAlternativeName("photo de l'artiste Nekfeu");
        $photo3->setUrl("https://media.gqmagazine.fr/photos/5dd240a335a5520008a7980d/4:3/w_3796,h_2847,c_limit/GettyImages-952796690.jpg");
        $photo3->addArtist($this->getReference(ArtistFixture::NEKFEU));
        $manager->persist($photo3);

        $photo4 = new Photo();
        $photo4->setName('nekfeu4');
        $photo4->setAlternativeName("photo de l'artiste Nekfeu");
        $photo4->setUrl("https://branchesculture.com/wp-content/uploads/2015/11/nekfeu-concert-5-novembre-ancienne-belgique-15.jpg");
        $photo4->addArtist($this->getReference(ArtistFixture::NEKFEU));
        $manager->persist($photo4);

        $photo5 = new Photo();
        $photo5->setName('Pomme');
        $photo5->setAlternativeName("photo de l'artiste Pomme");
        $photo5->setUrl("https://img.lemde.fr/2023/02/02/914/0/3648/1824/768/384/75/0/1eb43f0_1675349963007-00597564-000093.jpg");
        $photo5->addArtist($this->getReference(ArtistFixture::POMME));
        $manager->persist($photo5);

        $photo6 = new Photo();
        $photo6->setName('Pomme6');
        $photo6->setAlternativeName("photo de l'artiste Pomme");
        $photo6->setUrl("https://img.20mn.fr/HuK-6TacR4CQZRUoDYcEuik/768x492_chanteuse-pomme-enregistre-troisieme-album-dont-sortie-prevue-2022");
        $photo6->addArtist($this->getReference(ArtistFixture::POMME));
        $manager->persist($photo6);

        $photo7 = new Photo();
        $photo7->setName('Pomme7');
        $photo7->setAlternativeName("photo de l'artiste Pomme");
        $photo7->setUrl("https://tetu.com/wp-content/uploads/2019/11/2019-05-Pomme-Press-EmmaCORTIJO-12-1-e1573658125948.jpg");
        $photo7->addArtist($this->getReference(ArtistFixture::POMME));
        $manager->persist($photo7);

        $photo8 = new Photo();
        $photo8->setName('Pomme8');
        $photo8->setAlternativeName("photo de l'artiste Pomme");
        $photo8->setUrl("https://cdn-s-www.leprogres.fr/images/296ADFA2-8F76-41C0-9D4E-04AA779C1BA5/NW_raw/la-chanteuse-de-caluire-a-concu-des-vestes-certaines-sont-toutes-parties-photo-d-archives-progres-joel-philippon-1603330385.jpg");
        $photo8->addArtist($this->getReference(ArtistFixture::POMME));
        $manager->persist($photo8);

        $photo9 = new Photo();
        $photo9->setName('Alpha Wann');
        $photo9->setAlternativeName("photo de l'artiste Alpha Wann");
        $photo9->setUrl("https://www.radiofrance.fr/s3/cruiser-production/2020/10/89bf7acf-d37a-4280-bf2e-aa5bbc939d96/1200x680_alpha_wann.jpg");
        $photo9->addArtist($this->getReference(ArtistFixture::ALPHA));
        $manager->persist($photo9);

        $photo10 = new Photo();
        $photo10->setName('Alpha Wann10');
        $photo10->setAlternativeName("photo de l'artiste Alpha Wann");
        $photo10->setUrl("https://rapologie.fr/wp-content/uploads/2019/12/pistolet-rose-2.jpg");
        $photo10->addArtist($this->getReference(ArtistFixture::ALPHA));
        $manager->persist($photo10);

        $photo11 = new Photo();
        $photo11->setName('Alpha Wann11');
        $photo11->setAlternativeName("photo de l'artiste Alpha Wann");
        $photo11->setUrl("https://www.letempsmachine.com/sites/default/files/letempsmachine/styles/galerie_photos/public/ged/img_1web_2.jpg?itok=D_va0jXP");
        $photo11->addArtist($this->getReference(ArtistFixture::ALPHA));
        $manager->persist($photo11);

        $photo12 = new Photo();
        $photo12->setName('Alpha Wann12');
        $photo12->setAlternativeName("photo de l'artiste Alpha Wann");
        $photo12->setUrl("https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fwp-content%2Fblogs.dir%2F11%2Ffiles%2F2019%2F10%2Falpha-wann-freestyle-concert-paris-video-0.jpg?w=960&cbr=1&q=90&fit=max");
        $photo12->addArtist($this->getReference(ArtistFixture::ALPHA));
        $manager->persist($photo12);

        $photo13 = new Photo();
        $photo13->setName('Alpha Wann13');
        $photo13->setAlternativeName("photo de l'artiste Alpha Wann");
        $photo13->setUrl("https://www.francetvinfo.fr/pictures/sVHeLdzv_HD2YiQTgAeaLkYN5rs/752x423/2019/08/21/phpdLCzHu.jpg");
        $photo13->addArtist($this->getReference(ArtistFixture::ALPHA));
        $manager->persist($photo13);

        $photo14 = new Photo();
        $photo14->setName('The Police');
        $photo14->setAlternativeName("photo de l'artiste The Police");
        $photo14->setUrl("https://resize-rfm.lanmedia.fr/r/665,444,forcex,center-middle/img/var/rfm/storage/images/news/the-police-decouvrez-every-move-you-take-le-coffret-evenement-17334/248198-1-fre-FR/The-Police-Decouvrez-Every-Move-You-Take-le-coffret-evenement.jpg");
        $photo14->addArtist($this->getReference(ArtistFixture::THEPOLICE));
        $manager->persist($photo14);

        $photo15 = new Photo();
        $photo15->setName('The Police15');
        $photo15->setAlternativeName("photo de l'artiste The Police");
        $photo15->setUrl("https://www.lawofficer.com/wp-content/uploads/2017/10/hologram.png");
        $photo15->addArtist($this->getReference(ArtistFixture::THEPOLICE));
        $manager->persist($photo15);

        $photo16 = new Photo();
        $photo16->setName('The Police16');
        $photo16->setAlternativeName("photo de l'artiste The Police");
        $photo16->setUrl("https://images.rtl.fr/~c/770v513/rtl2/www/887801-the-police-can-t-stand-losing-you.jpg");
        $photo16->addArtist($this->getReference(ArtistFixture::THEPOLICE));
        $manager->persist($photo16);

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            ArtistFixture::class,
            ConcertHallFixture::class,
            ConcertFixture::class
        ];
    }

}
