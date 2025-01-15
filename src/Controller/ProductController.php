<?php

namespace App\Controller;

/*
use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController{

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/create', name: 'app_product_create')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
            'name' => 'Producto',
            'indexPath' => 'app_product'
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/product/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('app_product');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
            'name' => 'Producto',
            'indexPath' => 'app_product',
            'title' => 'Editar Producto',
            'button_label' => 'Guardar Cambios'
        ]);
    }

    #[Route('/product/remove/{id}', name: 'app_product_delete')]
    public function delete(Request $request, Product $product): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $this->em->remove($product);
            $this->em->flush();
        // }

        return $this->redirectToRoute('app_product');
    }
}
*/


use App\Entity\Product;
use App\Form\ProductType;
use App\Service\CrudService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product', name: 'app_product')]
class ProductController extends AbstractController
{
    private CrudService $crudService;
    private EntityManagerInterface $em;

    public function __construct(CrudService $crudService, EntityManagerInterface $em)
    {
        $this->crudService = $crudService;
        $this->em = $em;
    }

    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->crudService->list(Product::class, 'product/index.html.twig');
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        return $this->crudService->new($request, Product::class, ProductType::class, 'app_product_index');
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->crudService->show(Product::class, $product->getId(), 'product/show.html.twig');
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product): Response
    {
        return $this->crudService->edit($request, $product, ProductType::class, 'app_product_index');
    }

    // #[Route('/{id}', name: '_delete')]
    // public function delete(Request $request, Product $product): Response
    // {
    //     // $this->crudService->delete($request, $product, 'app_product_index');
    //     // $em = $this->em->remove($product);
    //     $this->em->remove($product);
    //     $this->addFlash('success', 'Producto eliminado correctamente.');

    //     return $this->redirectToRoute('app_product_index');
    // }

    #[Route('/{id}/remove', name: '_delete')]
    public function delete(Request $request, Product $product): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $this->em->remove($product);
            $this->em->flush();
        // }

        return $this->redirectToRoute('app_product_index');
    }
}