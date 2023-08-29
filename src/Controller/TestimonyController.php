<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Entity\Testimony;
use App\Form\TestimonyType;
use App\Repository\HourlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TestimonyController extends AbstractController
{
    #[Route('/commentaire', name: 'testimony')]
    public function index(
        EntityManagerInterface $manager,
        HttpFoundationRequest $request, 
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        ): Response
    {

        // Import Entity Hourly via the repository
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBy([]);

        // Create form testimony

        $testimony = new Testimony();
        $form = $this->createForm(TestimonyType::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testimony = $form->getData();

            $manager->persist($testimony);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre Commentaire à bien étais pris en compte'
            );

            return $this->redirectToRoute('index');
        }
        return $this->render('pages/testimony/testimony.html.twig', [
            'testimonyForm' => $form->createView(),
            'hourlys' => $hourlys,
        ]);
    }
}
