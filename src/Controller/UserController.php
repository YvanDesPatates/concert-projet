<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\ArtistRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id): Response
    {
        $user = $this->userRepository->find($id);
        $title = 'Modifier votre compte';
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $artist = $form->getData();
            $this->userRepository->save($artist, true);

            return $this->redirectToRoute('concerts');
        }

        return $this->render('user/_form.html.twig', [
            'form' => $form->createView(),
            'title'=> $title
        ]);
    }

    #[Route('/{idUser}/{idArtist}/like', name: 'like_artist', methods: ['GET', 'POST'])]
    public function like_artist(Request $request, int $idUser, int $idArtist, ArtistRepository $artistRepository): Response
    {
        $user = $this->userRepository->find($idUser);
        $artist = $artistRepository->find($idArtist);
        $user->addArtistsLiked($artist);
        $this->userRepository->save($user, true);
        return $this->redirectToRoute('artists');
    }

    #[Route('/{idUser}/{idArtist}/dislike', name: 'dislike_artist', methods: ['GET', 'POST'])]
    public function dislike_artist(Request $request, int $idUser, int $idArtist, ArtistRepository $artistRepository): Response
    {
        $user = $this->userRepository->find($idUser);
        $artist = $artistRepository->find($idArtist);
        $user->removeArtistsLiked($artist);
        $this->userRepository->save($user, true);
        return $this->redirectToRoute('artists');
    }
}
