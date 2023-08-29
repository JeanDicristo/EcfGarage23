<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Entity\Service;
use App\Entity\Testimony;
use App\Repository\HourlyRepository;
use App\Repository\ServiceRepository;
use App\Repository\TestimonyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        ServiceRepository $serviceRepository,
        TestimonyRepository $testimonyRepository,
    ): Response
    {
        // Import Entity Hourly via the repository
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBy([]);

        // Import Entity Service via the repository
        $serviceRepository = $doctrine->getRepository(Service::class);
        $services = $serviceRepository->findBy([]);

         // Import Entity Testimony via the repository
         $testimonyRepository = $doctrine->getRepository(Testimony::class);
         $testimonys = $testimonyRepository->findBy([]);

        return $this->render('pages/home/index.html.twig', [
           'hourlys' => $hourlys,
           'services' => $services,
           'testimonys' => $testimonys,
        ]);
    }
}
