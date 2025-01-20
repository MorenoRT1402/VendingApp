<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        $companyInfo = [ 
            'name' => 'Vending Solutions 24/7',
            'description' => 'We are a leading company in vending solutions, offering quality products 24 hours a day. 
                We focus on providing a reliable and convenient service for our customers.',            
            'values' => [
                'Quality', 'Convenience', 'Availability',
            ],
        ];

        return $this->render('home/about.html.twig', [
            'companyInfo' => $companyInfo,
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        $contactInfo = [
            'name' => 'Carlos Moreno Ortega',
            'email' => 'morecore.dev@gmail.com',
            'github' => 'MorenoRT1402',
            'linkedin' => 'carlos-moreno-ortega',
            'phone' => '+34 601121040'
        ];

        return $this->render('home/contact.html.twig', [
            'contactInfo' => $contactInfo,
        ]);
    }
}