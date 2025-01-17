<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product', name: 'app_product')]
final class ProductController extends AbstractController{

    private EntityManagerInterface $em;
    private FileUploader $fileUploader;

    public function __construct(EntityManagerInterface $em, FileUploader $fileUploader)
    {
        $this->em = $em;
        $this->fileUploader = $fileUploader;
    }

    function handleForm(Product $product, Request $request) {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imageFile')->getData();

            if ($file) {
                $newFilename = $this->fileUploader->upload($file);
                $product->setImage($newFilename);
            }

            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
            'indexPath' => 'app_product',
            'title' => 'Editar Producto',
            // 'button_label' => 'Guardar Cambios'
        ]);
    }

    #[Route('/', name: '')]
    public function index(): Response
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        $fields = [
            ['name' => 'name', 'label' => 'Nombre'],
            ['name' => 'price', 'label' => 'Precio'],
        ];

        return $this->render('_entity_list.html.twig', [
            'entities' => $products,
            'entity_name' => 'producto',
            'route_prefix' => 'app_product',
            'fields' => $fields,
        ]);
    }

    #[Route('/create', name: '_new')]
    public function new(Request $request): Response
    {
        $product = new Product();
        return $this->handleForm($product, $request);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, FileUploader $fileUploader): Response
    {
        return $this->handleForm($product, $request);
    }

    #[Route('/remove/{id}', name: '_delete')]
    public function delete(Request $request, Product $product): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $image = $product->getImage();
            if($image)
                $this->fileUploader->delete($image);

            $this->em->remove($product);
            $this->em->flush();
        // }

        return $this->redirectToRoute('app_product');
    }
}
