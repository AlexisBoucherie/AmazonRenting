<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\Event;
use App\Entity\Vehicle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
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
         return $this->redirect($adminUrlGenerator->setController(VehicleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Amazon Renting | Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Vehicle', 'fa fa-car')->setSubItems([
            MenuItem::linkToCrud('List of vehicles', 'fa fa-eye', Vehicle::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('New vehicle', 'fa fa-plus', Vehicle::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Event', 'fa fa-calendar-days')->setSubItems([
            MenuItem::linkToCrud('List of events', 'fa fa-eye', Event::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('New event', 'fa fa-plus', Event::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Company', 'fa fa-building')->setSubItems([
            MenuItem::linkToCrud('List of companies', 'fa fa-eye', Company::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('New company', 'fa fa-plus', Company::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::linkToUrl("Leave administration", "fa-solid fa-arrow-right-from-bracket", '/home');
    }
}
