<?php

namespace App\Controller;

use App\Form\SendEmailType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;

class MailerController extends AbstractController
{
    #[Route('/mailer', name: 'app_mailer', methods: ['GET', 'POST'])]
    public function index(CompanyRepository $companyRepository): Response
    {
        $company = $companyRepository->find(['id' => 8]);
        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
            'company' => $company,
        ]);
    }

    #[Route('/email', name: 'app_mailer_send', methods: ['GET', 'POST'])]
    public function sendEmail(MailerInterface $mailer, Request $request, CompanyRepository $companyRepository): Response
    {
        $form = $this->createForm(SendEmailType::class);
        $form->handleRequest($request);
        $company = $companyRepository->find(['id' => 8]);
        $emailCompany = $company->getEmail();
        $text = $_POST['message'];
        $status = $_POST['status'];
        $emailForm = $_POST['email'];
        $email = (new Email())
            ->from($emailForm)
            ->to('admin@amazonrenting.com')
            ->cc($emailCompany)
            ->subject('Appointment for ' . $status)
            ->text($text)
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->addFlash('success','Mail Send!');
        $mailer->send($email);
        return $this->redirectToRoute('app_mailer', [], Response::HTTP_SEE_OTHER);
    }
}
