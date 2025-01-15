<?php

namespace App\Controller;

use App\Entity\Machine;
use App\Form\MachineType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(self::ROUTE_PREFIX, name: self::ROUTE_NAME)]
final class MachineController extends AbstractController{
    private const ROUTE_NAME = 'app_machine';
    private const ENTITY_NAME = 'máquina';
    private const PREFIX = 'machine';

    private const ROUTE_PREFIX = '/' . self::PREFIX;
    
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    private function get_data($machines) : array {
        $data = [];
        foreach ($machines as $machine) {
            $data[] = [
                'id' => $machine->getId(),
                'model' => $machine->getModel(),
                'location' => $machine->getLocation(),
                'status' => $machine->getStatus()?->value,
            ];
        }
        return $data;
    }

    #[Route('/', name: '')]
    public function index(): Response
    {
        $machines = $this->em->getRepository(Machine::class)->findAll();
        
        $data = $this->get_data($machines);

        $fields = [
            ['name' => 'model', 'label' => 'Modelo'],
            ['name' => 'location', 'label' => 'Localización'],
            ['name' => 'status', 'label' => 'Estado'],
        ];

        return $this->render('_entity_list.html.twig', [
            'entities' => $data,
            'entity_name' => self::ENTITY_NAME,
            'route_prefix' => self::ROUTE_NAME,
            'fields' => $fields,
        ]);
    }

    #[Route('/create', name: '_new')]
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

        return $this->render(self::PREFIX . '/create.html.twig', [
            'form' => $form->createView(),
            'newText' => 'Nueva Máquina',
            'indexPath' => 'app_machine'
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Machine $machine): Response
    {
        return $this->render('machine/show.html.twig', [
            'machine' => $machine,
        ]);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Machine $machine): Response
    {
        $form = $this->createForm(MachineType::class, $machine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('app_machine');
        }

        return $this->render(self::PREFIX . '/create.html.twig', [
            'form' => $form->createView(),
            'newText' => 'Editar Máquina',
            'indexPath' => 'app_machine',
            'title' => 'Editar Máquina',
            'button_label' => 'Guardar Cambios'
        ]);
    }

    #[Route('/remove/{id}', name: '_delete')]
    public function delete(Machine $machine): Response
    {
        $this->em->remove($machine);
        $this->em->flush();

        return $this->redirectToRoute('app_machine');
    }
}
