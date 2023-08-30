<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Equipment;
use App\Entity\ProfilUser;
use App\Entity\Service;
use App\Entity\Testimony;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('V.Parrot - Administation')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
         yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Marque', 'fa-solid fa-id-card', Brand::class);
        yield MenuItem::linkToCrud('Service', 'fa-solid fa-id-card', Service::class);
        yield MenuItem::linkToCrud('Commentaire', 'fa-solid fa-id-card', Testimony::class);
        yield MenuItem::linkToCrud('Équipement', 'fa-solid fa-id-card', Equipment::class);
        yield MenuItem::linkToCrud('Voiture', 'fa-solid fa-id-card', Product::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fa-solid fa-id-card', ProfilUser::class);
         //PRODUCT <i class="fa-solid fa-product"></i>
         //Contact <i class="fa-solid fa-address-card"></i>
    }
}
