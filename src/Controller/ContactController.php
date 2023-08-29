<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Hourly;
use App\Form\ContactType;
use App\Repository\HourlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(
        ManagerRegistry $doctrine,
        HttpFoundationRequest $request, 
        EntityManagerInterface $manager,
        HourlyRepository $hourlyRepository,
        ): Response
    {

        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBY([]);

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message à bien étais envoyer'
            );

            return $this->redirectToRoute('index');
        }
        return $this->render('pages/contact/contact.html.twig', [
            'contactForm' => $form->createView(),
            'form' => $form->createView(),
            'hourlys' => $hourlys,
        ]);
    }
}
