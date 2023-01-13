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
    #[Route('/profile/{id}', name: 'app_user')]
    public function index(User $user): Response
    {
        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profile/edit/{id}', name: 'app_user_edit')]
    public function edit(User $user,UserRepository $userRepository, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData()->getPassword();
            if ($password){
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            }
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
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
