<?php

namespace App\Controller\Admin;

use App\Entity\Personaje;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;



class PersonajeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Personaje::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(), 
            TextField::new('name', 'Nombre'),
            TextEditorField::new('description', 'Descripción')->setRequired(false),
            TextField::new('image', 'URL Imagen'),
            DateTimeField::new('deletedAt', 'Fecha de eliminación')->setRequired(false),
            AssociationField::new('planeta', 'Planeta') 
            ->setFormTypeOption('choice_label', 'name')  
            ->setRequired(true),
        ];
    }
}
