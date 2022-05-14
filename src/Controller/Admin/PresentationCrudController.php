<?php

namespace App\Controller\Admin;

use App\Entity\Presentation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PresentationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Presentation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Projets')
            ->setPageTitle('new', 'Créer une présentation')
            ->setPageTitle('edit', 'Modifier une présentation');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Texte de présentation')
                ->onlyOnForms(),
            TextField::new('mail', 'Mail de contact'),
            TextField::new('cv', 'URL du cv'),
            TextField::new('linkedin', 'Lien vers Linkedin'),
            TextField::new('github', 'Lien vers Github'),
            TextEditorField::new('news', 'Quoi de neuf ?')
                ->onlyOnForms(),
        ];
    }
}
