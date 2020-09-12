<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("/cat", name="app_cat")
     */
    public function index()
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    /**
     * @Route("/cat/addCat", name="app_cat_addCat", methods="GET|POST" )     
     */
    public function addCat(Request $request, EntityManagerInterface $em) 
    { 
        $form = $this->createFormBuilder()
            ->add('Code', TextType::class)
            ->add('libelle', TextType::class)
            ->add('categorie', EntityType::class, array(
                'class' => 'App:Categorie',
                'choice_label' => 'libelle',
            ))
            ->add('description', TextType::class)
            ->add('submit', SubmitType::class, ['label'=>'Valider'])
            ->getForm()
        ; 
        //dd($form);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          //  dd($request->request->all());
          $data = $form->getData();
         // dd($data);
          $prod = new Categorie;
          $prod->setCodecategorie($data['Code']);
          $prod->setLibelle($data['libelle']);
          $prod->setCategorie($data['categorie']);
          $prod->setDescription($data['description']);
          $em->persist($prod);
          $em->flush();
          return $this->redirectToRoute('app_cat_addCat');
        }
        return $this->render('categorie/addCat.html.twig', 
            ['forms' =>$form->createView()]);
    }
     /**
     * @Route("/cat/listCat", name="app_cat_listCat", methods="GET|POST" )     
     */
    public function listCat(CategorieRepository $cr) 
    { 
        return $this->render('categorie/listCat.html.twig', ['prods'=> $cr->findAll()]);
    }
}
