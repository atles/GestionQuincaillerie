<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\QuincaillerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/art/all", name="art_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse     
     */
    public function getAll(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
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
     * @Route("/art/{id<[0-9]+>}", name="art_one", methods={"GET"} )
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
     * @Route("/art/add", name="art_add", methods={"POST"} )
     * @param Requeste $requeste
     * @return JsonResponse     
     */
    public function add(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,
                                EntityManagerInterface $emi) : JsonResponse
    {
        // dd("add");
        $data = json_decode($request->getContent(), true);

        $article = new Article;
        $quincaillerie = $repquinc->find($data['quincaillerie']);
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
     * @Route("/art/update/{id<[0-9]+>}", name="art_update", methods={"PUT"} )
     * @param Requeste $requeste
     * @return JsonResponse     
     */
    public function update(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,
                                EntityManagerInterface $emi, int $id) : JsonResponse
    {
        // dd("update");
        $data = json_decode($request->getContent(), true);

        $article = $rep->find($id);
        $quincaillerie = $repquinc->find($data['quincaillerie']);
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
     * @Route("/art/deletes", name="art_deletes", methods={"PATCH"} )
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function deletes(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,
                                EntityManagerInterface $emi) : JsonResponse
    {
        // dd("delete");
        $data = json_decode($request->getContent(), true);
        foreach($data as $id){
            $article = $rep->find($id);
            $emi -> remove($article);
        }
        $emi->flush();
        return new JsonResponse(['status'=>'Articles supprimer'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/art/delete/{id<[0-9]+>}", name="art_delete", methods={"DELETE"} )
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,
                                EntityManagerInterface $emi, int $id) : JsonResponse
    {
        // dd("delete");
        $data = json_decode($request->getContent(), true);

        $article = $rep->find($id);
        $emi -> remove($article);
        $emi->flush();
        return new JsonResponse(['status'=>'Article supprimer'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/art/clones", name="art_clones", methods={"POST"} )
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function clones(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,EntityManagerInterface $emi):JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // dd($data);
        foreach($data as $id){
            $article = clone $rep->find($id);
            $emi ->persist($article);
        }
        $emi->flush();

        return new JsonResponse(['status'=>'Articles cloner avec success'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/art/clone/{id<[0-9]+>}", name="art_clone", methods={"POST"} )
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner(QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $rep,Request $request,EntityManagerInterface $emi,int $id):JsonResponse
    {
        $article = $rep->find($id);
        $articleclone = clone $article;
        $emi -> persist($articleclone);
        $emi->flush();

        return new JsonResponse(['status'=>'Article cloner avec success'], Response::HTTP_CREATED);
    }
}
