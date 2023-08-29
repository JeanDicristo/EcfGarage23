<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Entity\Product;
use App\Data\SearchData;
use App\Form\ProductType;
use App\Form\SearchForm;
use App\Repository\HourlyRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/vehicule', name: 'product')]
    public function index(ProductRepository $repository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $products = $repository->findSearch($data);

        return $this->render('pages/product/car.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }

    // Function New Product
    #[Route('/nouveau', name: 'newProduct')]
    public function new(   
        HttpFoundationRequest $request,
        HourlyRepository $hourlyRepository,
        EntityManagerInterface $manager,) 
    {

    // Import Entity Hourly via the repository
    $hourlyRepository = $manager->getRepository(Hourly::class);
    $hourlys = $hourlyRepository->findBy([]);

    $product = new Product();
    $form = $this->createForm(ProductType::class, $product);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $product = $form->getData();

        $manager->persist($product);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre voiture à bien étais prise en compte'
        );
    }

    return $this->render('pages/product/new.html.twig', [
        'productForm' => $form->createView(),
        'hourlys' => $hourlys
    ]);
    }
}
