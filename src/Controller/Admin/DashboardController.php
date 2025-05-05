<?php

namespace App\Controller\Admin;

use App\Entity\YourEntity; // Replace with your actual entity
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        
        // Redirect to one of your CRUD controllers
        return $this->redirect($adminUrlGenerator->setController(YourEntityCrudController::class)->generateUrl());
        
        // OR if you want to keep the dashboard:
        // return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Your Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Your Entity', 'fas fa-list', YourEntity::class);
        // Add more menu items as needed
    }
}