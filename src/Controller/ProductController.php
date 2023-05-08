<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product/create', name: 'create_product')]
    public function create(EntityManagerInterface $entityManager, Product $product=null, Request $request, MailerService $mailerService ):Response
    {
        //Creation du formulaire

        $form= $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $product= $form->getData();
            $entityManager->persist($product);
            $entityManager->flush();
            
            //Ajout du message Flash
            $this->addFlash('success',"Produit ajouté");
            //Ajout de l'email
            $mailerService->sendProductActivationEmail($product);
            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/create.html.twig', [
           'formAddProduct' => $form->createView(),
        ]);
    }

    #[Route('/product', name: 'app_product')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // j'affiche uniquement les produits activés
        $products= $doctrine->getRepository(Product::class)->findBy(['enabled'=>1]);
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/activate/{id}', name: 'activate_product')]
    public function activate(Product $product, EntityManagerInterface $entityManager, MailerService $mailerService
    ): Response
    {
        $product->setEnabled(true);
        $entityManager->flush();

        $this->addFlash('success', "Le produit a été activé");
        $mailerService->sendProductActivatedEmail($product);

        return $this->redirectToRoute('app_product');
    }
}
