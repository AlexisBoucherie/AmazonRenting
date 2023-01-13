<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    #[Route('/company', name: 'app_company')]
    public function index(CompanyRepository $companyRepository): Response
    {
        $company = $companyRepository->findOneById(1);

        $cars = $company->getVehicles();

        return $this->render('company/index.html.twig', [
            'company' => $company,
            'cars' => $cars
        ]);
    }
}
