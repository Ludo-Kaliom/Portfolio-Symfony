<?php

namespace App\Controller\Admin;

use App\Entity\Projects;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projects::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Projets')
            ->setPageTitle('new', 'Créer un projet')
            ->setPageTitle('edit', 'Modifier un projet');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('image', 'Image')
                ->onlyOnIndex()
                ->setBasePath('/uploads/images'),
            TextField::new('imageFiles', 'Fichier')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            TextField::new('title', 'Titre'),
            TextField::new('short_description', 'Courte description'),
            TextField::new('subtitle', 'Sous-titre'),
            TextField::new('category', 'Catégorie'),
            TextEditorField::new('item', 'Description longue du projet')
                ->onlyOnForms(),
            AssociationField::new('technologies', 'Technologies'),
            TextField::new('site_label', 'Label du site')
                ->onlyOnForms(),
            TextField::new('site_link', 'Lien du site')
                ->onlyOnForms(),
            TextField::new('git_label', 'Label du git')
                ->onlyOnForms(),
            TextField::new('git_link', 'Lien du git')
                ->onlyOnForms(),
            IntegerField::new('priority', "Priorité d'affichage"),
            BooleanField::new('status', 'Afficher sur le site'),
        ];
    }
}
