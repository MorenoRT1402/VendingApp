<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class CrudService
{
    private EntityManagerInterface $em;
    private FormFactoryInterface $formFactory;
    private UrlGeneratorInterface $urlGenerator;
    private Environment $twig;

    public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory, UrlGeneratorInterface $urlGenerator, Environment $twig)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
    }

    private function getRepository(string $entityClass): ObjectRepository
    {
        return $this->em->getRepository($entityClass);
    }

    public function list(string $entityClass, string $template, array $criteria = [], array $orderBy = null, int $limit = null, int $offset = null): Response
    {
        $entities = $this->getRepository($entityClass)->findBy($criteria, $orderBy, $limit, $offset);

        return new Response($this->twig->render($template, ['entities' => $entities]));
    }

    public function new(Request $request, string $entityClass, string $formTypeClass, string $routeName): Response
    {
        $entity = new $entityClass();
        $form = $this->formFactory->create($formTypeClass, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($entity);
            $this->em->flush();

            $url = $this->urlGenerator->generate($routeName);
            return new RedirectResponse($url);
        }

        return new Response($this->twig->render('create.html.twig', [
            'form' => $form->createView(),
            'name' => (new \ReflectionClass($entityClass))->getShortName(),
            'indexPath' => $routeName,
        ]));
    }

    public function show(string $entityClass, int $id, string $template): Response
    {
        $entity = $this->getRepository($entityClass)->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Entity not found.');
        }

        return new Response($this->twig->render($template, ['entity' => $entity]));
    }

    public function edit(Request $request, object $entity, string $formTypeClass, string $routeName): Response
    {
        $form = $this->formFactory->create($formTypeClass, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $url = $this->urlGenerator->generate($routeName);
            return new RedirectResponse($url);
        }

        return new Response($this->twig->render('create.html.twig', [
            'form' => $form->createView(),
            'name' => (new \ReflectionClass($entity))->getShortName(),
            'indexPath' => $routeName,
            'title' => 'Editar ' . (new \ReflectionClass($entity))->getShortName(),
            'button_label' => 'Guardar Cambios'
        ]));
    }

    public function delete(Request $request, object $entity, string $routeName): Response
    {
        $this->em->remove($entity);
        $this->em->flush();

        $url = $this->urlGenerator->generate($routeName);
            return new RedirectResponse($url);
    }
}