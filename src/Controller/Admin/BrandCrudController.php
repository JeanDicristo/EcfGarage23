<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Brand::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Marques')
        ->setEntityLabelInSingular('Marque')

        ->setPageTitle('index',  'Administration Garage V.Parrot');
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
    }
    
}
