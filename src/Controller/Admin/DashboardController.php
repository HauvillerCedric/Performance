<?php

namespace App\Controller\Admin;

use App\Entity\Actuality;
use App\Entity\Agency;
use App\Entity\Gateway;
use App\Entity\Licence;
use App\Entity\Perfectionnement;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Dashboard, MenuItem, UserMenu};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator, private UploaderHelper $uploaderHelper)
    {
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/assets/images/logoPerformance.png">')
            ->setFaviconPath('/assets/images/favicon_easyAdmin.svg')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        $this->isGranted('ROLE_SUPER_ADMIN') ? yield MenuItem::linkToCrud('Utilisateurs','fa fa-users', User::class ) : yield MenuItem::linkToCrud('Utilisateur','fa fa-user', User::class );
        yield MenuItem::linkToCrud('Actualités','fa fa-newspaper', Actuality::class );
        yield MenuItem::linkToCrud('Agences', 'fa fa-building', Agency::class);
        yield MenuItem::linkToRoute('Retour au site', 'fa fa-door-open', 'app_homepage_index' );
        yield MenuItem::linkToLogout('Déconnexion', 'fa fa-right-to-bracket');
        yield MenuItem::section('Patron', 'fa fa-solid')->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::subMenu('Permis et passerelle', 'fa fa-circle-down')->setSubItems([
            MenuItem::linkToCrud('Permis de conduire', 'fa fa-id-card', Licence::class)->setPermission('ROLE_SUPER_ADMIN'),
            MenuItem::linkToCrud('Passerelle', 'fa fa-bridge', Gateway::class)->setPermission('ROLE_SUPER_ADMIN')
        ]);
        yield MenuItem::linkToCrud('Perfectionnement', 'fa fa-thumbs-up', Perfectionnement::class)->setPermission('ROLE_SUPER_ADMIN');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        $user = $this->getUser();
        $urlMyProfile = $this->adminUrlGenerator
            ->unsetAll()
            ->setController(UserCrudController::class)
            ->setAction(Action::EDIT)
            ->setEntityId($user->getId())
            ->generateUrl()
        ;

        return parent::configureUserMenu($user)
            ->setName($user->getEmail())
            ->setAvatarUrl($this->uploaderHelper->asset($user, $user->getImageFile()))
            ->addMenuItems([
                MenuItem::linkToUrl('Mon profil', 'fa fa-user-edit', $urlMyProfile),
            ])
            ;
    }
}
