<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Quincaillerie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
   
   /**
     * @Route("/", name="app_article_addArticle", methods="GET|POST" )     
     */
    /* public function addArticle(Request $request, EntityManagerInterface $em) 
    { 
        $form = $this->createFormBuilder()
            ->add('libelle', TextType::class)
            ->add('prix-en-cours', TextType::class)
            ->add('unite', TextType::class)
            ->add('code-article', TextType::class)
            ->add('description', TextType::class)
            ->add('categorie', EntityType::class, array(
                'class' => 'App:Categorie',
                'choice_label' => 'libelle',
            ))
            ->add('quincaillerie', EntityType::class, array(
                'class' => 'App:Quincaillerie',
                'choice_label' => 'libellequic',
            ))
            ->add('submit', SubmitType::class, ['label'=>'creer categorie'])
            ->getForm()
        ; 
        //dd($form);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          //  dd($request->request->all());
            $data = $form->getData();
            $cat = new Categorie;
            $cat->setNomCat($data['nom']);
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute('app_procat_listCat');
        }
        return $this->render('procat/addCat.html.twig', 
            ['forms' =>$form->createView()]);
    } */
}
