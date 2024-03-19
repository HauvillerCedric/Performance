<?php

namespace App\Controller\Admin;

use App\Entity\Agency;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{EmailField, Field, FormField, ImageField, TimeField};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Filters};

class AgencyCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Agency::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Agence')
            ->setEntityLabelInPlural('Agences')
            ->setPageTitle('index', 'Agences')
            ->setPageTitle('detail', 'Agence')
            ->setDefaultSort(['id' => 'ASC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('city')
            ->add('street')
            ->add('zip')
            ->add('mobile')
            ->add('email')
            ;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        $entityInstance->setUser($this->getUser());
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::BATCH_DELETE)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) {
            yield Field::new('city')->setLabel('Ville');
            yield Field::new('street')->setLabel('Rue');
            yield Field::new('zip')->setLabel('Code Postal');
            yield Field::new('mobile')->setLabel('Téléphone');
            yield EmailField::new('email')->setLabel('Email');
            yield ImageField::new('imageName')->setBasePath('uploads/images/agencies')->setLabel('Photo de l\'agence');
        }
        elseif (in_array($pageName, [Crud::PAGE_NEW, Crud::PAGE_EDIT])) {
            yield FormField::addTab('Coordonées', 'fa fa-address-book');
            yield FormField::addColumn(6,);
            yield FormField::addFieldset('Adresse');
            yield Field::new('city')->setLabel('Ville');
            yield Field::new('street')->setLabel('Rue');;
            yield Field::new('street')->setLabel('Rue');
            yield Field::new('zip')->setLabel('Code Postal');
            yield FormField::addColumn(6);
            yield FormField::addFieldset('Contact');
            yield Field::new('mobile')->setLabel('Téléphone');
            yield EmailField::new('email')->setLabel('Email');
            yield FormField::addTab('Horaires', 'fa fa-clock');
            yield FormField::addColumn(6, 'Ouverture');
            yield FormField::addFieldset('Lundi')->collapsible()->renderCollapsed();
            yield TimeField::new('mondayOpening')->setLabel('lundi');
            yield FormField::addFieldset('Mardi')->collapsible()->renderCollapsed();
            yield TimeField::new('tuesdayOpening')->setLabel('Mardi');
            yield FormField::addFieldset('Mercredi')->collapsible()->renderCollapsed();
            yield TimeField::new('wednesdayOpening')->setLabel('Mercredi');
            yield FormField::addFieldset('Jeudi')->collapsible()->renderCollapsed();
            yield TimeField::new('thursdayOpening')->setLabel('Jeudi');
            yield FormField::addFieldset('vendredi')->collapsible()->renderCollapsed();
            yield TimeField::new('fridayOpening')->setLabel('Vendredi');
            yield FormField::addFieldset('Samedi')->collapsible()->renderCollapsed();
            yield TimeField::new('saturdayOpening')->setLabel('Samedi');
            yield FormField::addFieldset('Dimanche')->collapsible()->renderCollapsed();
            yield TimeField::new('sundayOpening')->setLabel('Dimanche');
            yield FormField::addColumn(6, 'Fermeture');
            yield FormField::addFieldset('Lundi')->collapsible()->renderCollapsed();
            yield TimeField::new('mondayClosing')->setLabel('lundi');
            yield FormField::addFieldset('Mardi')->collapsible()->renderCollapsed();
            yield TimeField::new('tuesdayClosing')->setLabel('Mardi');
            yield FormField::addFieldset('Mercredi')->collapsible()->renderCollapsed();
            yield TimeField::new('wednesdayClosing')->setLabel('Mercredi');
            yield FormField::addFieldset('Jeudi')->collapsible()->renderCollapsed();
            yield TimeField::new('thursdayClosing')->setLabel('Jeudi');
            yield FormField::addFieldset('vendredi')->collapsible()->renderCollapsed();
            yield TimeField::new('fridayClosing')->setLabel('Vendredi');
            yield FormField::addFieldset('Samedi')->collapsible()->renderCollapsed();
            yield TimeField::new('saturdayClosing')->setLabel('Samedi');
            yield FormField::addFieldset('Dimanche')->collapsible()->renderCollapsed();
            yield TimeField::new('sundayClosing')->setLabel('Dimanche');
            yield FormField::addTab('Photo de l\'agence', 'fa fa-image');
            yield ImageField::new('imageName')->setUploadDir('public/uploads/images/agencies')->setBasePath('uploads/images/agencies')->setUploadedFileNamePattern('[timestamp].[extension]')->setLabel('Photo de l\'agence');
        }

        elseif (Crud::PAGE_DETAIL === $pageName) {
            yield FormField::addColumn(6);
            yield FormField::addFieldset('Informations', 'fa fa-info');
            yield Field::new('city')->setLabel('Ville');
            yield Field::new('street')->setLabel('Rue');;
            yield Field::new('zip')->setLabel('Code Postal');
            yield Field::new('mobile')->setLabel('Téléphone');
            yield EmailField::new('email')->setLabel('Email');
            yield ImageField::new('imageName')->setBasePath('uploads/images/agencies')->setLabel('Photo de l\'agence');;
            yield FormField::addColumn(6);
            yield FormField::addFieldset('Horaires', 'fa fa-clock');
            yield FormField::addFieldset('Lundi')->collapsible();
            yield TimeField::new('mondayOpening')->setLabel('lundi');
            yield TimeField::new('mondayClosing')->setLabel('lundi');
            yield FormField::addFieldset('Mardi')->collapsible();
            yield TimeField::new('tuesdayOpening')->setLabel('Mardi');
            yield TimeField::new('tuesdayClosing')->setLabel('Mardi');
            yield FormField::addFieldset('Mercredi')->collapsible();
            yield TimeField::new('wednesdayOpening')->setLabel('Mercredi');
            yield TimeField::new('wednesdayClosing')->setLabel('Mercredi');
            yield FormField::addFieldset('Jeudi')->collapsible();
            yield TimeField::new('thursdayOpening')->setLabel('Jeudi');
            yield TimeField::new('thursdayClosing')->setLabel('Jeudi');
            yield FormField::addFieldset('vendredi')->collapsible();
            yield TimeField::new('fridayOpening')->setLabel('Vendredi');
            yield TimeField::new('fridayClosing')->setLabel('Vendredi');
            yield FormField::addFieldset('Samedi')->collapsible();
            yield TimeField::new('saturdayOpening')->setLabel('Samedi');
            yield TimeField::new('saturdayClosing')->setLabel('Samedi');
            yield FormField::addFieldset('Dimanche')->collapsible();
            yield TimeField::new('sundayOpening')->setLabel('Dimanche');
            yield TimeField::new('sundayClosing')->setLabel('Dimanche');
        }
    }
}
