<?php

namespace App\Controller\Admin;

use App\Entity\Gateway;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions};

class GatewayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gateway::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Passerelle')
            ->setEntityLabelInPlural('Passerelle')
            ->setPageTitle('index', 'Passerelle')
            ->setPageTitle('detail', 'Passerelle')
            ->setEntityPermission('ROLE_SUPER_ADMIN');
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        $entityInstance->setUser($this->getUser());
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {

        if (in_array($pageName, [Crud::PAGE_INDEX, Crud::PAGE_NEW, Crud::PAGE_EDIT, Crud::PAGE_DETAIL])) {
            yield MoneyField::new('inscriptionFee')->setLabel('Frais d\'inscription')->setCurrency('EUR')->setNumDecimals(0)->setStoredAsCents(false);
            yield MoneyField::new('driving')->setLabel('Heure de conduite')->setCurrency('EUR')->setNumDecimals(0)->setStoredAsCents(false);
        }
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::BATCH_DELETE)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;

    }
}
