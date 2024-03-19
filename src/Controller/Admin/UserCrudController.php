<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Trait\PasswordTrait;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, Filters};
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{BooleanField, DateTimeField, EmailField, Field, ImageField, TextareaField, FormField};
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\QueryBuilder;


class UserCrudController extends AbstractCrudController
{
    use PasswordTrait;

    public function __construct(private RequestStack $requestStack, private EntityManagerInterface $em, private AdminUrlGenerator $adminUrlGenerator, private UserPasswordHasherInterface $passwordHasher)
    {
    }
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilsateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ->setPageTitle('index', $this->isGranted('ROLE_SUPER_ADMIN') ? 'Utilisateurs' : 'Utilisateur')
            ->setPageTitle('detail', 'Utilisateur')
            ->setDefaultSort(['id' => 'ASC'])
            ->setPaginatorPageSize(10);
    }

    public function persistEntity($em, $entity): void
    {
        $this->checkEntityWithPasswordBeforeFlushTrait($entity);

        parent::persistEntity($em, $entity);
    }

    public function updateEntity($em, $entity): void
    {
        $this->checkEntityWithPasswordBeforeFlushTrait($entity);

        parent::updateEntity($em, $entity);
    }

    public function createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters): QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        if( !$this->isGranted('ROLE_SUPER_ADMIN') )
        {
            $qb->andWhere('entity.id = :id')
                ->setParameter('id', $this->getUser()->getId())
            ;
        }

        return $qb;
    }

    public function configureActions(Actions $actions): Actions
    {
        $rpUser = $this->em->getRepository(User::class);
        $isSuperAdmin = $this->getUser() && in_array('ROLE_SUPER_ADMIN', $this->getUser()->getRoles());
        $actions = $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE);

        if (!$isSuperAdmin) {
            $actions->remove(Crud::PAGE_INDEX, Action::NEW);
        }

        $entityId = $this->requestStack->getCurrentRequest()->get('entityId', null);
        $entity = null;
        if ($entityId) {
            $entity = $rpUser->find($entityId);
        }

        if ($entity) {
            if ($entity->getId() != $this->getUser()->getId() && !$this->isGranted('ROLE_SUPER_ADMIN')) {
                $actions->remove(Crud::PAGE_DETAIL, Action::EDIT);
                $actions->remove(Crud::PAGE_DETAIL, Action::DELETE);
            }
        }

        return $actions;
    }

    public function configureFilters(Filters $filters): Filters
    {
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $filters
                ->add('firstName')
                ->add('lastName')
                ->add('email')
                ->add('fonction')
                ->add('isActive')
                ->add('createdAt');
        }

        return $filters;
    }


    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName){
            yield Field::new('firstName')->setLabel('Prénom');
            yield Field::new('lastName')->setLabel('Nom');
            yield EmailField::new('email');
            yield ImageField::new('imageName')->setBasePath('uploads/images/users')->setLabel('Photo de profil');
            yield Field::new('fonction');
            yield TextareaField::new('description');
            yield BooleanField::new('isActive')->setLabel('Toujours en poste')->renderAsSwitch(false);
            yield DateTimeField::new('createdAt')->setLabel('Crée le');
            yield DateTimeField::new('updatedAt')->setLabel('modifié le');
        }
        elseif (Crud::PAGE_NEW == $pageName){
            yield FormField::addTab('Utilisateur', 'fa fa-user');
            yield Field::new('firstName')->setLabel('Prénom')->setColumns(6);
            yield Field::new('lastName')->setLabel('Nom')->setColumns(6);
            yield EmailField::new('email');
            yield ImageField::new('imageName')->setUploadDir('public/uploads/images/users')->setBasePath('uploads/images/users')->setUploadedFileNamePattern('[timestamp].[extension]')->setLabel('Photo de profil');
            yield FormField::addTab('Mot de passe', 'fa fa-key');
            yield Field::new('plainPassword')->setLabel('Mot de passe')->setFormType(PasswordType::class);
            yield FormField::addTab('Infomation', 'fa fa-comment');
            yield Field::new('fonction');
            yield TextareaField::new('description');
        }
        elseif (Crud::PAGE_EDIT == $pageName){
            yield FormField::addTab('Utilisateur', 'fa fa-user');
            yield Field::new('firstName')->setLabel('Prénom')->setColumns(6);
            yield Field::new('lastName')->setLabel('Nom')->setColumns(6);
            yield EmailField::new('email')->setDisabled(!$this->isGranted('ROLE_SUPER_ADMIN'));
            yield ImageField::new('imageName')->setUploadDir('public/uploads/images/users')->setBasePath('uploads/images/users')->setUploadedFileNamePattern('[timestamp].[extension]')->setLabel('Photo de profil');
            yield BooleanField::new('isActive')->setLabel('Toujours employé')->setDisabled(!$this->isGranted('ROLE_SUPER_ADMIN'));
            yield FormField::addTab('Mot de passe', 'fa fa-key');
            yield Field::new('plainPassword')->setDisabled()->setLabel('Mot de passe')->setFormType(PasswordType::class);
            yield FormField::addTab('Infomation', 'fa fa-comment');
            yield Field::new('fonction');
            yield TextareaField::new('description');
        }
        elseif (Crud::PAGE_DETAIL == $pageName){
            yield Field::new('firstName')->setLabel('Prénom');
            yield Field::new('lastName')->setLabel('Nom');
            yield EmailField::new('email');
            yield ImageField::new('imageName')->setUploadDir('public/uploads/images/users')->setBasePath('uploads/images/users')->setUploadedFileNamePattern('[timestamp].[extension]')->setLabel('Photo de profil');
            yield BooleanField::new('isActive')->setLabel('Toujours employé')->renderAsSwitch(false);
            yield Field::new('fonction');
            yield TextareaField::new('description');
        }
    }
}
