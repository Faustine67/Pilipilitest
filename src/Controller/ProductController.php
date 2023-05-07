<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product/create', name: 'create_product')]
    public function create(EntityManagerInterface $entityManager, Product $product=null, Request $request): Response
    {
        //Creation du formulaire

        $form= $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $product= $form->getData();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/create.html.twig', [
           'formAddProduct' => $form->createView(),
        ]);
    }

    #[Route('/product', name: 'app_product')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // j'affiche tous les produits
        $products= $doctrine->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
