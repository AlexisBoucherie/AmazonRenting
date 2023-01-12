<?php

namespace App\Controller;

use App\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation')]
    public function index(Vehicle $vehicle): Response
    {
        return $this->render('reservation/reservation.html.twig', [
            'controller_name' => 'ReservationController',
            'car' => $vehicle
        ]);
    }
}
