<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route(self::ROUTE_PREFIX, name: self::ROUTE_NAME)]
final class LoginController extends AbstractController{
    private const ROUTE_NAME = 'app_auth';
    private const PREFIX = 'auth';

    private const ROUTE_PREFIX = '/' . self::PREFIX;

    #[Route('/login', name: '_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: '_logout')]
    public function logout(): void {}
}
