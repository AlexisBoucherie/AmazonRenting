<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\SearchLocationFormType;
use App\Repository\VehicleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, VehicleRepository $vehicleRepository): Response
    {
        $cars = $vehicleRepository->findAll();
        $form = $this->createForm(SearchLocationFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $data = $form->getData();
            $pricesRange= explode("-",$form->getData()['price']);
            $minPrice=trim($pricesRange[0]);
            $minPrice=str_replace('$','',$minPrice);
            $maxPrice=trim($pricesRange[1]);
            $maxPrice=str_replace('$','',$maxPrice);
            $location=$data['location'];
            $rentDate=$data['date'];
            $returnLocation=$data['returnLocation'];
            $returnDate=$data['returnDate'];
            $cars = $vehicleRepository->findAvailableVehicle($rentDate, $returnDate, $minPrice, $maxPrice, $location, $returnLocation);
            return $this->render('availableVehicles.html.twig', [
                'cars' => $cars,
                'startDate' => $rentDate,
                'endDate' => $returnDate,
            ]);
        }
        $carSport = $vehicleRepository->findBy(['type' => 'sportive']);
        $carUtility = $vehicleRepository->findBy(['type' => 'utilitaire']);
        return $this->render('home/index.html.twig', [
            'cars' => $cars,
            'carSport' => $carSport,
            'carUtility' => $carUtility,
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
        ]);
    }
}
