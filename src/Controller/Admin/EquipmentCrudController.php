<?php

namespace App\Controller\Admin;

use App\Entity\Equipment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquipmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipment::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Équipements')
        ->setEntityLabelInSingular('Équipement')

        ->setPageTitle('index',  'Administration Garage V.Parrot');
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
    }
    
}
