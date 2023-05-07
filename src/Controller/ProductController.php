<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
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
