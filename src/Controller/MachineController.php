<?php

namespace App\Controller;

use App\Entity\Machine;
use App\Form\MachineType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MachineController extends AbstractController{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    #[Route('/machine', name: 'app_machine')]
    public function index(): Response
    {
        $machine = $this->em->getRepository(Machine::class)->findAll();

        return $this->render('machine/index.html.twig', [
            'machine' => $machine,
        ]);
    }

    #[Route('/machine/create', name: 'app_machine_create')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $machine = new Machine();
        $form = $this->createForm(MachineType::class, $machine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($machine);
            $entityManager->flush();

            return $this->redirectToRoute('app_machine');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
            'name' => 'Máquina',
            'indexPath' => 'app_machine'
        ]);
    }

    #[Route('/machine/{id}', name: 'app_machine_show', methods: ['GET'])]
    public function show(Machine $machine): Response
    {
        return $this->render('machine/show.html.twig', [
            'machine' => $machine,
        ]);
    }

    #[Route('/machine/{id}/edit', name: 'app_machine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Machine $machine): Response
    {
        $form = $this->createForm(MachineType::class, $machine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('app_machine');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
            'name' => 'Máquina',
            'indexPath' => 'app_machine',
            'title' => 'Editar Máquina',
            'button_label' => 'Guardar Cambios'
        ]);
    }

    #[Route('/machine/remove/{id}', name: 'app_machine_delete')]
    public function delete(Machine $machine): Response
    {
        $this->em->remove($machine);
        $this->em->flush();

        return $this->redirectToRoute('app_machine');
    }
}
