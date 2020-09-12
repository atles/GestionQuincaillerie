<?php

namespace App\Controller;

use App\Entity\Quincaillerie;
use App\Repository\QuincaillerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuincaillerieController extends AbstractController
{
    /**
     * @Route("/quinc/addQuinc", name="app_quinc_addQuinc", methods="GET|POST" )     
     */
    public function addQuinc(Request $request, EntityManagerInterface $em) 
    { 
        $form = $this->createFormBuilder()
            ->add('libelle', TextType::class)
            ->add('Code', TextType::class)
            ->add('email', TextType::class)
            ->add('telephone', TextType::class)
            ->add('adresse', TextType::class)
            ->add('ville', TextType::class)
            ->add('region', TextType::class)
            ->add('longetude', TextType::class)
            ->add('latitude', TextType::class)
            ->add('submit', SubmitType::class, ['label'=>'Valider'])
            ->getForm()
        ; 
        //dd($form);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          //  dd($request->request->all());
          $data = $form->getData();
         // dd($data);
          $prod = new Quincaillerie;
          $prod->setLibellequic($data['libelle']);
          $prod->setCodequinc($data['Code']);
          $prod->setEmail($data['email']);
          $prod->setTel($data['telephone']);
          $prod->setAdresse($data['adresse']);
          $prod->setVille($data['ville']);
          $prod->setRegion($data['region']);
          $prod->setLonge($data['longetude']);
          $prod->setLat($data['latitude']);
          $em->persist($prod);
          $em->flush();
          return $this->redirectToRoute('app_quinc_listQuinc');
        }
        return $this->render('quincaillerie/addQuinc.html.twig', 
            ['forms' =>$form->createView()]);
    }
     /**
     * @Route("/quinc/listQuinc", name="app_quinc_listQuinc", methods="GET|POST" )     
     */
    public function listQuinc(QuincaillerieRepository $qr) 
    { 
        return $this->render('quincaillerie/listQuinc.html.twig', ['prods'=> $qr->findAll()]);
    }
    /**
     * @Route("/quinc/supQuinc/{id}", name="app_quinc_supQuinc", methods="GET|POST" )     
     */
    public function SupQuinc(QuincaillerieRepository $qr, $id, EntityManagerInterface $em) 
    { 
        $prod = $qr->find($id);
       // dd($prod);
        $em -> remove($prod);
        $em->flush();
        return $this->render('quincaillerie/listQuinc.html.twig', ['prods'=> $qr->findAll()]);
    }
     /**
     * @Route("/quinc/modQuinc/{id}/{lib}/{code}/{email}/{tel}/{adresse}/{ville}/{region}/{long}}/{lat}", name="app_quinc_modQuinc", methods="GET|POST" )     
     */
    public function ModProduit(Request $request, QuincaillerieRepository $qr, $id, EntityManagerInterface $em, 
        $lib, $code, $email, $tel, $adresse, $ville, $region, $long, $lat) 
    { 
        $tab = ['libelle'=>$lib, 'Code'=>$code, 'email'=>$email, 'telephone'=>$tel, 'adresse'=>$adresse, 
        'ville'=>$ville, 'region'=>$region, 'longetude'=>$long, 'latitude'=>$lat];
        $form = $this->createFormBuilder($tab)
            ->add('libelle', TextType::class)
            ->add('Code', TextType::class)
            ->add('email', TextType::class)
            ->add('telephone', TextType::class)
            ->add('adresse', TextType::class)
            ->add('ville', TextType::class)
            ->add('region', TextType::class)
            ->add('longetude', TextType::class)
            ->add('latitude', TextType::class)
            ->add('submit', SubmitType::class, ['label'=>'Valider'])
            ->getForm()
        ; 
        //dd($form);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          //  dd($request->request->all());
            $data = $form->getData();
            $prod = $qr->find($id);
            $prod->setLibellequic($data['libelle']);
            $prod->setCodequinc($data['Code']);
            $prod->setEmail($data['email']);
            $prod->setTel($data['telephone']);
            $prod->setAdresse($data['adresse']);
            $prod->setVille($data['ville']);
            $prod->setRegion($data['region']);
            $prod->setLonge($data['longetude']);
            $prod->setLat($data['latitude']);
            $em->merge($prod);
            $em->flush();
            return $this->render('quincaillerie/listQuinc.html.twig', ['prods'=> $qr->findAll()]);
        }
        return $this->render('quincaillerie/addQuinc.html.twig', 
            ['forms' =>$form->createView()]);
    }
    /**
     * @Route("/quinc/cloneQuinc/{id}", name="app_quinc_cloneQuinc", methods="GET|POST" )     
     */
    public function CloneQuinc(Request $request, QuincaillerieRepository $qr, EntityManagerInterface $em,
        $id) 
    { 
        $prod = $qr->find($id);
        $copy = clone $prod;
        $em->persist($copy);
        $em->flush();
        return $this->render('quincaillerie/listQuinc.html.twig', ['prods'=> $qr->findAll()]);
        
    }
}
