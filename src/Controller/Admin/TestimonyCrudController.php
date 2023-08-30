<?php

namespace App\Controller\Admin;

use App\Entity\Testimony;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TestimonyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Testimony::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Commentaires')
        ->setEntityLabelInSingular('Commentaire')

        ->setPageTitle('index',  'Administration Garage V.Parrot');
    }

    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
    }
    
}
