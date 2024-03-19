<?php

namespace App\Controller\Admin;

use App\Entity\Licence;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{Field, MoneyField, FormField};


class LicenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Licence::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Permis')
            ->setEntityLabelInPlural('Permis')
            ->setPageTitle('index', 'Permis')
            ->setPageTitle('detail', 'Permis')
            ->setEntityPermission('ROLE_SUPER_ADMIN');
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        $entityInstance->setUser($this->getUser());
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureFields (string $pageName):iterable
    {
    if (Crud::PAGE_INDEX === $pageName) {
            yield Field::new('title')->setLabel('Nom');
            yield MoneyField::new('inscriptionFee')->setLabel('Frais d\'inscription')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('book')->setLabel('Livret de conduite')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('codeBook')->setLabel('Livret de code')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('codePackage')->setLabel('Préparation code')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('codeTest')->setLabel('Examen théorique')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('driving')->setLabel('Heure de conduite')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('drivingTest')->setLabel('Examen pratique')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('inspectionsBook')->setLabel('Livret mécanique')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('card')->setLabel('Fabrication du permis')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('inspectionWorkshop')->setLabel('Atelier mécanique')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('preliminaryMeeting')->setLabel('RDV préalable')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('firstPedagogicalMeeting')->setLabel('RDVP1')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('secondPedagogicalMeeting')->setLabel('RDVP2')->setStoredAsCents(false)->setCurrency('EUR');
        }
    elseif (in_array($pageName, [Crud::PAGE_NEW, Crud::PAGE_EDIT, Crud::PAGE_DETAIL])) {
            yield FormField::addTab('Tous Permis', 'fa fa-id-card');
            yield FormField::addColumn(6);
            yield Field::new('title')->setLabel('Nom du permis')->setDisabled();
            yield MoneyField::new('inscriptionFee')->setLabel('Frais d\'inscription')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('codePackage')->setLabel('Préparation code')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('codeTest')->setLabel('Examen théorique')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('driving')->setLabel('Heure de conduite')->setStoredAsCents(false)->setCurrency('EUR');
            yield FormField::addColumn(6);
            yield FormField::addFieldset();
            yield MoneyField::new('book')->setLabel('Livret de conduite')->setStoredAsCents(false)->setCurrency('EUR')->setColumns(6);
            yield MoneyField::new('codeBook')->setLabel('Livret de code')->setStoredAsCents(false)->setCurrency('EUR')->setColumns(6);
            yield FormField::addTab('Permis B et BEA', 'fa fa-b');
            yield MoneyField::new('drivingTest')->setLabel('Examen pratique')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('inspectionsBook')->setLabel('Livret mécanique')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('card')->setLabel('Fabrication du permis')->setStoredAsCents(false)->setCurrency('EUR');
            yield MoneyField::new('inspectionWorkshop')->setLabel('Atelier mécanique')->setStoredAsCents(false)->setCurrency('EUR');+
            yield FormField::addTab('Permis AAC', 'fa fa-baby');
            yield MoneyField::new('preliminaryMeeting')->setLabel('RDV préalable')->setStoredAsCents(false)->setCurrency('EUR');
            yield FormField::addPanel('RDV Pédagogique');
            yield MoneyField::new('firstPedagogicalMeeting')->setLabel('RDVP1')->setStoredAsCents(false)->setCurrency('EUR')->setColumns(6);
            yield MoneyField::new('secondPedagogicalMeeting')->setLabel('RDVP2')->setStoredAsCents(false)->setCurrency('EUR')->setColumns(6);
        }
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

}
