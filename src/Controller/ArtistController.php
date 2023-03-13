<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use App\Repository\ConcertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/artist')]
class ArtistController extends AbstractController
{
    private ArtistRepository $artistRepository;
    private ConcertRepository $concertRepository;

    public function __construct(ArtistRepository $artistRepository, ConcertRepository $concertRepository)
    {
        $this->artistRepository = $artistRepository;
        $this->concertRepository = $concertRepository;
    }

    #[Route('/', name: 'artists')]
    public function allArtists(Security $security): Response
    {
        $user = $security->getUser();
        $likedArtists = array();
        if ($user)
            $likedArtists = $user->getArtistsLiked();
        $artists = $this->artistRepository->findAll();
        return $this->render('artist/artistsList.html.twig', [
            'artists' => $artists,
            'likedArtists' => $likedArtists]);
    }

    #[Route('/{id}', name: 'artist', requirements: ['id' => '\d+'])]
    public function oneArtist(int $id): Response
    {
        $artist = $this->artistRepository->find($id);
        $allConcerts = $this->concertRepository->findAllNext();
        $concerts = array();
        foreach ($allConcerts as $concert){
            if ($concert->getArtistsPerformers()->contains($artist)){
                $concerts[] = $concert;
            }
        }
        return $this->render('artist/artist.html.twig', [
            'artist' => $artist,
            'concerts' => $concerts
            ]);
    }

    #[Route('/new/admin', name: 'app_artist_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $artist = new Artist();
        return $this->createOrUpdateArtist($request, $artist);
    }

    #[Route('/{id}/edit/admin', name: 'app_artist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artist $artist): Response
    {
        return $this->createOrUpdateArtist($request, $artist);
    }

    #[Route('/{id}/delete/admin', name: 'app_artist_delete')]
    public function delete(Request $request, Artist $artist): Response
    {
        $this->artistRepository->remove($artist, true);
        return $this->redirectToRoute('artists');
    }

    private function createOrUpdateArtist(Request $request, Artist $artist): Response{
        $title = is_null($artist->getId()) ? 'Créer artist' : 'Modifier artist';
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $artist = $form->getData();
            $this->artistRepository->save($artist, true);

            return $this->redirectToRoute('artists');
        }

        return $this->render('artist/_form.html.twig', [
            'form' => $form->createView(),
            'title'=> $title
        ]);
    }
}
