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
            TextField::new('ki', 'Base KI'),
            TextField::new('maxKi', 'Max KI'),
            TextField::new('race', 'Raza'),
            TextField::new('gender', 'Género'),
            TextEditorField::new('description', 'Descripción')->setRequired(false),
            TextField::new('image', 'URL Imagen'),
            TextField::new('affiliation', 'Afiliación'),
            DateTimeField::new('deletedAt', 'Fecha de eliminación')->setRequired(false),
            AssociationField::new('planeta', 'Planeta') 
            ->setFormTypeOption('choice_label', 'name')  
            ->setRequired(true),
        ];
    }
}
