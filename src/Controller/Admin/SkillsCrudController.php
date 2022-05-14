<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SkillsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skills::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Technologies')
            ->setPageTitle('new', 'Créer une compétence')
            ->setPageTitle('edit', 'Modifier une compétence');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('image', 'Image')
                ->onlyOnIndex()
                ->setBasePath('/uploads/images'),
            TextField::new('title', 'Titre'),
            TextField::new('short_description', 'Courte description'),
            TextField::new('imageFiles', 'Fichier')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
        ];
    }
}
