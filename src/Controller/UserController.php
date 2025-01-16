<?php

namespace App\Controller;

use App\Entity\User;
use App\Enum\UserRoles;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route(self::ROUTE_PREFIX, name: self::ROUTE_NAME)]
final class UserController extends AbstractController{
    private const ROUTE_NAME = 'app_user';
    private const ENTITY_NAME = 'usuario';
    private const PREFIX = 'user';

    private const ROUTE_PREFIX = '/' . self::PREFIX;
    
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    #[Route('/register', name: '_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setRoles([UserRoles::USER->value]);
            $user->setPassword($passwordHasher->hashPassword($user, $form->get('password')->getData()));

            $this->em->persist($user);
            $this->em->flush();

            return $this->redirectToRoute(self::ROUTE_NAME . '_register');
        }

        return $this->render(self::PREFIX . '/create.html.twig', [
            'form' => $form->createView(),
            'newText' => 'Registro',
            'indexPath' => 'app_user_register'
        ]);
    }
}
