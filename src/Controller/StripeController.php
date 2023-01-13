<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Vehicle;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Stripe;

class StripeController extends AbstractController
{
    #[Route('/stripe', name: 'app_stripe')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $totalPrice=$session->get('totalPrice');

        return $this->render('stripe/index.html.twig', [
            'stripe_key' => $_ENV["STRIPE_KEY"],
            'totalPrice'=>$totalPrice
        ]);
    }

    #[Route('/stripe/create-charge', name: 'app_stripe_charge', methods: ['POST'])]
    public function createCharge(Request $request, EntityManagerInterface $manager,VehicleRepository $vehicleRepository, UserRepository $userRepository): Response
    {
        $user= $userRepository->findOneBy(['id' => 1]);
        $session=$request->getSession();
        Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
        Stripe\Charge::create([
            "amount" => 5 * 100,
            "currency" => "usd",
            "source" => $request->request->get('stripeToken'),
            "description" => "Binaryboxtuts Payment Test"
        ]);
        $this->addFlash(
            'success',
            'Payment Successful!'
);
        $event = new Event();
        $event->setStatus('rented');
        $event->setPrice($session->get('totalPrice'));
        $event->setVehicleId($vehicleRepository->findOneBy(['id'=>$session->get('vehicleId')]));
        $event->setEndDate($session->get('returnDate'));
        $event->setLicenceNumber($session->get('licenceNumber'));
        $event->setUserId($user);
        $event->setStartDate($session->get('rentDate'));
        $event->setEndDate($session->get('returnDate'));
        $event->setReturnLocalisation($session->get('returnLocation'));
        $event->setStartCondition('good');
        $manager->persist($event);
        $manager->flush();
        $session->clear();
return $this->redirectToRoute('app_stripe', [], Response::HTTP_SEE_OTHER);
}
}
