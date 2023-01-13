<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Form\ReservationFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation')]
    public function index(Request $request,UserRepository $repository ,Vehicle $vehicle): Response
    {
        $user= $repository->findOneBy(['id' => 1]);
        $session = $request->getSession();
        $rentDate = $session->get('rentDate');
        $returnDate = $session->get('returnDate');
        $location = $session->get('location');
        $returnLocation = $session->get('returnLocation');
        $numberOfDays=date_diff($rentDate, $returnDate);
        $numberOfDays = $numberOfDays->format('%d');
        $totalPrice = $numberOfDays * $vehicle->getPrice();
        $session->set('totalPrice', $totalPrice);
        $session->set('vehicleId', $vehicle->getId());
        $form=$this->createForm(ReservationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $licenceNumber=$form->getData()['licenceNumber'];
            $session->set('licenceNumber', $licenceNumber);
            return $this->redirectToRoute('app_stripe');
        }

        return $this->render('reservation/reservation.html.twig', [
            'rentDate' => $rentDate,
            'returnDate' => $returnDate,
            'location' => $location,
            'returnLocation' => $returnLocation,
            'car' => $vehicle,
            'numberOfDays'=> $numberOfDays,
            'totalPrice'=>$totalPrice,
            'user'=>$user,
            'form'=>$form->createView(),
        ]);
    }
}
