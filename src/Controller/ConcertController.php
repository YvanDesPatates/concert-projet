<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\ConcertType;
use App\Repository\ConcertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    private ConcertRepository $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }


    #[Route('/', name: 'concertsAVenir')]
    public function index(): Response
    {   $concerts = $this->concertRepository->findAllNext();
        return $this->render('concert/concertsList.html.twig', [
            'concerts' => $concerts
        ]);
    }

    #[Route('/concerts', name: 'concerts')]
    public function allConcerts(): Response
    {   $concert = $this->concertRepository->findAll();
        return $this->render('concert/concertsList.html.twig', [
            'concerts' => $concert
        ]);
    }

    #[Route('/concerts/{year}', name: 'concert_par_annee')]
    public function concertAnne(int $year): Response
    {   $concerts = $this->concertRepository->findByYear($year);
        return $this->render('concert/concertsByYear.html.twig', [
            'concerts' => $concerts,
            'year' => $year
        ]);
    }

    #[Route('/concert/{id}', name: 'concert', requirements: ['id' => '\d+'])]
    public function oneConcert(int $id): Response
    {
        $concert = $this->concertRepository->find($id);
        return $this->render('concert/concert.html.twig', ['concert' => $concert]);
    }

    #[Route('/concert/create/admin', name: 'concert_create')]
    public function createConcert(Request $request): Response {
        $concert = new Concert();
        return $this->createOrUpdateConcert($request, $concert);
    }

    #[Route('/concert/update{id}/admin', name: 'concert_update')]
    public function updateConcert(Request $request, $id): Response {
        $concert = $this->concertRepository->find($id);
        return $this->createOrUpdateConcert($request, $concert);
    }

    #[Route('/concert/delete{id}/admin', name: 'concert_delete', requirements: ['id' => '\d+'])]
    public function deleteConcert(int $id): Response
    {
        $concert = $this->concertRepository->find($id);
        if ( !is_null($concert)) {
            $this->concertRepository->remove($concert, true);
        }
        return $this->redirectToRoute('concerts');
    }

    private function createOrUpdateConcert(Request $request, Concert $concert): Response{
        $title = is_null($concert->getId()) ? 'Nouveau concert' : 'Modifier concert';
        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $concert = $form->getData();
            $this->concertRepository->save($concert, true);

            return $this->redirectToRoute('concerts');
        }

        return $this->render('concert/form.html.twig', [
            'form' => $form->createView(),
            'title'=> $title
        ]);
    }
}
