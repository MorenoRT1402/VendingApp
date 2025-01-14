<?php

namespace App\Controller;

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
    public function index(EntityManagerInterface $entityManager): Response
    {
        $products = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/create', name: 'create_product')]
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
}
