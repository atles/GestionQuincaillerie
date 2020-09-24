<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Quincaillerie;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\QuincaillerieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticlesController extends AbstractController
{
     /**
     * @Route("/article/all", name="article_all", methods={"GET"} )
     * @param Requeste $requeste
     * @return JsonResponse     
     */
    public function gatAll(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep)
    {
        $data = $rep->findAll();
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                "id" => $item->getId(),
                "libelle" => $item->getLibelle(),
                "prixencours" => $item->getPrixencours(),
                "unite" => $item->getUnite(),
                "codearticle" => $item->getCodearticle(),
                "description" => $item->getDescription(),
                "quincaillerie" => array(
                    "id" => $item->getQuincaillerie()->getId(),
                    "Libellequic" => $item->getQuincaillerie()->getLibellequic(),
                    "codequinc" => $item->getQuincaillerie()->getCodequinc(),
                    "email" => $item->getQuincaillerie()->getEmail(),
                    "tel" => $item->getQuincaillerie()->getTel(),
                    "adresse" => $item->getQuincaillerie()->getAdresse(),
                    "ville" => $item->getQuincaillerie()->getVille(),
                    "region" => $item->getQuincaillerie()->getRegion(),
                    "longe" => $item->getQuincaillerie()->getLonge(),
                    "lat" => $item->getQuincaillerie()->getLat()
                ),
                "categorie" => array(
                    "id" => $item->getCategorie()->getId(),
                    "codecategorie" => $item->getCategorie()->getCodecategorie(),
                    "libelle" => $item->getCategorie()->getLibelle(),
                    "categorie" => $item->getCategorie()->getCategorie(),
                    "description" => $item->getCategorie()->getDescription()
                )
            );
        }
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/article/{id<[0-9]+>}", name="article_one", methods={"GET"} )
     * @param Requeste $requeste
     * @return JsonResponse     
     */
    public function gatOne(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,int $id)
    {
        $data = $rep->find($id);
        $dataclection = array(
            "id" => $data->getId(),
            "libelle" => $data->getLibelle(),
            "prixencours" => $data->getPrixencours(),
            "unite" => $data->getUnite(),
            "codearticle" => $data->getCodearticle(),
            "description" => $data->getDescription(),
            "quincaillerie" => array(
                "id" => $data->getQuincaillerie()->getId(),
                "Libellequic" => $data->getQuincaillerie()->getLibellequic(),
                "codequinc" => $data->getQuincaillerie()->getCodequinc(),
                "email" => $data->getQuincaillerie()->getEmail(),
                "tel" => $data->getQuincaillerie()->getTel(),
                "adresse" => $data->getQuincaillerie()->getAdresse(),
                "ville" => $data->getQuincaillerie()->getVille(),
                "region" => $data->getQuincaillerie()->getRegion(),
                "longe" => $data->getQuincaillerie()->getLonge(),
                "lat" => $data->getQuincaillerie()->getLat()
            ),
            "categorie" => array(
                "id" => $data->getCategorie()->getId(),
                "codecategorie" => $data->getCategorie()->getCodecategorie(),
                "libelle" => $data->getCategorie()->getLibelle(),
                "categorie" => $data->getCategorie()->getCategorie(),
                "description" => $data->getCategorie()->getDescription()
            )
        );
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/article/add", name="article_add", methods={"POST"} )
     * @param Requeste $requeste
     * @return JsonResponse     
     */
    public function add(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,
                                EntityManager $emi) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $article = new Article;
        $quincaillerie = $repquinc->find($data['qincaillerie']);
        $categorie = $repcat->find($data['categorie']);
        $article->setLibelle($data['libelle']);
        $article->setPrixencours($data['prixencours']);
        $article->setUnite($data['unite']);
        $article->setCodearticle($data['codearticle']);
        $article->setDescription($data['description']);
        $article->setQuincaillerie($quincaillerie);
        $article->setCategorie($categorie);
        $emi -> persist($article);
        $emi->flush();
        return new JsonResponse(['status'=>'Article created'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/article/update/{id<[0-9]+>}", name="article_update", methods={"PUT"} )
     * @param Requeste $requeste
     * @return JsonResponse     
     */
    public function update(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,
                                EntityManager $emi, int $id) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $article = $rep->find($id);
        $quincaillerie = $repquinc->find($data['qincaillerie']);
        $categorie = $repcat->find($data['categorie']);
        $article->setLibelle($data['libelle']);
        $article->setPrixencours($data['prixencours']);
        $article->setUnite($data['unite']);
        $article->setCodearticle($data['codearticle']);
        $article->setDescription($data['description']);
        $article->setQuincaillerie($quincaillerie);
        $article->setCategorie($categorie);
        $emi -> persist($article);
        $emi->flush();
        return new JsonResponse(['status'=>'Article mise en jour success'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/article/delete/{id<[0-9]+>}", name="article_delete", methods={"DELETE"} )
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,
                                EntityManager $emi, $id) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $article = $rep->find($id);
        $emi -> remove($article);
        $emi->flush();
        return new JsonResponse(['status'=>'Article supprimer'], Response::HTTP_CREATED);
    }

}
