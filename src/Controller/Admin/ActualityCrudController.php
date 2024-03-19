<?php

namespace App\Controller\Admin;

use App\Entity\Actuality;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ActualityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actuality::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Actualité')
            ->setEntityLabelInPlural('Actualités')
            ->setPageTitle('index', 'Actualités')
            ->setPageTitle('detail', 'Actualité');
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        $entityInstance->setUser($this->getUser());
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureFields( string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) {
            yield TextField::new('user')->setLabel('Posté par');
            yield Field::new('title')->setLabel('Titre');
            yield TextareaField::new('description')->setLabel('Article');
            yield TimeField::new('createdAt')->setLabel('Ajouté le');
            yield TimeField::new('updatedAt')->setLabel('Modifié le ');
            yield ImageField::new('imageName')->setBasePath('uploads/images/actualities')->setLabel('image de l\'article');
        }
         elseif (in_array($pageName, [Crud::PAGE_NEW, Crud::PAGE_EDIT, Crud::PAGE_DETAIL])) {
            yield Field::new('title')->setLabel('Titre');
            yield TextEditorField::new('description')->setLabel('Article');
            yield ImageField::new('imageName')->setUploadDir('public/uploads/images/actualities')->setBasePath('uploads/images/actualities')->setUploadedFileNamePattern('[timestamp].[extension]')->setLabel('Image de l\'article');
            yield SlugField::new('slug')->setLabel('URL')->setTargetFieldName('title');
        }
    }
}
