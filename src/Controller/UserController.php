<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneById(1);

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profile/edit', name: 'app_user_edit')]
    public function edit(UserRepository $userRepository, Request $request): Response
    {
        $user = $userRepository->findOneById(1);


        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData()->getPassword();
            if ($password){
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            }
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/user_edit.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }

    #[Route('/profile/{id}/event', name: 'app_user_reservation')]
    public function showReservation(User $user): Response
    {
        $events = $user->getEvents();

        return $this->render('user/user_event.html.twig', [
            'user' => $user,
            'events' => $events
        ]);
    }
}
