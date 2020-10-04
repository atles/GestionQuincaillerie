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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends AbstractController
{
    /**
     * @Route("/catategorie", name="categorie")
     */
    public function index()
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    /**
     * @Route("/categorie/all", name="article_all", methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll(CategorieRepository $rep){
        $data = $rep->findAll();
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                "id" => $item->getId(),
                "codecategorie" => $item->getCodecategorie(),
                "libelle" => $item->getLibelle(),
                "categorie" => array(
                    "id" => $item->getCategorie()->getId(),
                    "codecategorie" => $item->getCategorie()->getCodecategorie(),
                    "liebelle" => $item->getCategorie()->getLibelle(),
                    "categorie" => $item->getCategorie()->getCategorie(),
                    "description" => $item->getCategorie()->getDescription()
                ),
                "description" => $item->getDescription()
            );
        }
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/categorie/{id<[0-9]+>}", name="article_one", methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getOne(int $id,CategorieRepository $rep){
        
        $data = $rep->find($id);
        $dataclection = array(
            "id" => $data->getId(),
            "codecategorie" => $data->getCodecategorie(),
            "libelle" => $data->getLibelle(),
            "categorie" => array(
                "id" => $data->getCategorie()->getId(),
                "codecategorie" => $data->getCategorie()->getCodecategorie(),
                "liebelle" => $data->getCategorie()->getLibelle(),
                "categorie" => $data->getCategorie()->getCategorie(),
                "description" => $data->getCategorie()->getDescription()
            ),
            "description" => $data->getDescription()
        );
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/categorie/add", name="article_add", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(CategorieRepository $rep,EntityManagerInterface $emi,Request $request):JsonResponse{

        $data = json_decode($request->getContent(), true);
        $categorie = new Categorie;
        $cat = $rep->find($data['categorie']);
        $categorie->setCodecategorie($data['codecategorie']);
        $categorie->setLibelle($data['libelle']);
        $categorie->setCategorie($cat);
        $categorie->setDescription($data['description']);
        $emi->persist($categorie);
        $emi->flush();
        return new JsonResponse(['status'=>'Categorie created'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/categorie/update/{id<[0-9]+>}", name="article_update", methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update(CategorieRepository $rep, EntityManagerInterface $emi,
                            Request $request, int $id):JsonResponse{

        $data = json_decode($request->getContent(), true);
        $categorie = $rep->find($id);
        $cat = $rep->find($data['categorie']);
        $categorie->setCodecategorie($data['codecategorie']);
        $categorie->setLibelle($data['libelle']);
        $categorie->setCategorie($cat);
        $categorie->setDescription($data['description']);
        $emi->persist($categorie);
        $emi->flush();
        return new JsonResponse(['status'=>'Categorie modifier'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/categorie/delete/{id<[0-9]+>}", name="article_delete", methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(CategorieRepository $rep,EntityManagerInterface $emi, int $id):JsonResponse{
       
        $categorie = $rep->find($id);
        $emi->remove($categorie);
        $emi->flush();
        return new JsonResponse(['status'=>'categorie supprimer'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/categorie/clone/{id<[0-9]+>}", name="article_clone", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner(CategorieRepository $rep,EntityManagerInterface $emi, int $id):JsonResponse{
       
        $categorie = $rep->find($id);
        $categorieclone = clone $categorie;
        $emi->persist($categorieclone);
        $emi->flush();
        return new JsonResponse(['status'=>'categorie cloner avec success'], Response::HTTP_CREATED);
    }
}
