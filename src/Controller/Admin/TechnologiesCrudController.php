<?php

namespace App\Controller\Admin;

use App\Entity\Technologies;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TechnologiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Technologies::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Technologies')
            ->setPageTitle('new', 'Créer une technologie')
            ->setPageTitle('edit', 'Modifier une technologie');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
        ];
    }
}
