<?php

namespace App\Controller;

use App\Form\SendEmailType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;

class MailerController extends AbstractController
{
    #[Route('/mailer', name: 'app_mailer', methods: ['GET', 'POST'])]
    public function index(CompanyRepository $companyRepository): Response
    {
        $company = $companyRepository->findOneById(1);

        return $this->render('mailer/index.html.twig', [
            'company' => $company,
        ]);
    }

    #[Route('/email', name: 'app_mailer_send', methods: ['GET', 'POST'])]
    public function sendEmail(MailerInterface $mailer, Request $request, CompanyRepository $companyRepository): Response
    {
        $company = $companyRepository->findOneById(1);

        $form = $this->createForm(SendEmailType::class);
        $form->handleRequest($request);
        $email = (new Email())
            ->from($_POST['email'])
            ->to('admin@amazonrenting.com')
            ->cc($company->getEmail())
            ->subject('Appointment for ' . $_POST['status'])
            ->text($_POST['message'])
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->addFlash('success','Mail Send!');
        $mailer->send($email);
        return $this->redirectToRoute('app_mailer', [], Response::HTTP_SEE_OTHER);
    }
}
