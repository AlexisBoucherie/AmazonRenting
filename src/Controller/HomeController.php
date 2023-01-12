<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        $cars = $vehicleRepository->findAll();
        return $this->render('home/index.html.twig', [
            'cars' => $cars,
            'controller_name' => 'HomeController',
        ]);
    }
}
