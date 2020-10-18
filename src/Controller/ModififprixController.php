<?php

namespace App\Controller;

use App\Entity\Modifprix;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\ModifprixRepository;
use App\Repository\QuincaillerieRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModififprixController extends AbstractController
{
    /**
     * @Route("/modifprix", name="modififprix")
     */
    public function index()
    {
        return $this->render('modififprix/index.html.twig', [
            'controller_name' => 'ModififprixController',
        ]);
    }
     /**
     * @Route("/modifprix/all", name="modififprix_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll( QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                            ArticleRepository $repArt,EntityManagerInterface $emi,
                            ModifprixRepository $rep){
        // dd($rep->findAll());
        $data = $rep->findAll();
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                'id' => $item->getId(),
                'datemodif' => $item->getDatemodif(),
                'prix' => $item->getPrix(),
                'remarque' => $item->getRemarque(),
                'ancienprix' => $item->getAncienprix(),
                'article' =>  array(
                    'id' => $item->getArticle()->getId(),
                    'libelle' => $item->getArticle()->getLibelle(),
                    'prixencours' => $item->getArticle()->getPrixencours(),
                    'unite' => $item->getArticle()->getUnite(),
                    'codearticle' => $item->getArticle()->getCodearticle(),
                    'description' => $item->getArticle()->getDescription(),
                    'quincaillerie' => array(
                        'id' => $item->getArticle()->getQuincaillerie()->getId(),
                        'libellequic' => $item->getArticle()->getQuincaillerie()->getLibellequic(),
                        'codequinc' => $item->getArticle()->getQuincaillerie()->getCodequinc(),
                        'tel' => $item->getArticle()->getQuincaillerie()->getTel(),
                        'email' => $item->getArticle()->getQuincaillerie()->getEmail(),
                        'adresse' => $item->getArticle()->getQuincaillerie()->getAdresse(),
                        'ville' => $item->getArticle()->getQuincaillerie()->getVille(),
                        'region' => $item->getArticle()->getQuincaillerie()->getRegion(),
                        'lat' => $item->getArticle()->getQuincaillerie()->getLat(),
                        'long' => $item->getArticle()->getQuincaillerie()->getLonge()
                    ),
                    'categorie' => array(
                        'id' => $item->getArticle()->getCategorie()->getId(),
                        'codecategorie' => $item->getArticle()->getCategorie()->getCodecategorie(),
                        'libelle' => $item->getArticle()->getCategorie()->getLibelle(),
                        'categorie' => array(
                            'id' => $item->getArticle()->getCategorie()->getCategorie()->getId(),
                            'codecategorie' => $item->getArticle()->getCategorie()->getCategorie()->getCodecategorie(),
                            'libelle' => $item->getArticle()->getCategorie()->getCategorie()->getLibelle(),
                            'categorie' => $item->getArticle()->getCategorie()->getCategorie()->getCategorie(),
                            'description' => $item->getArticle()->getCategorie()->getCategorie()->getDescription()
                        ),
                        'description' => $item->getArticle()->getCategorie()->getDescription()
                    )
                )
            );
        }
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/modifprix/{id<[0-9]+>}", name="modififprix_one", methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getOne(int $id, QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                           ArticleRepository $repArt,EntityManagerInterface $emi,
                           ModifprixRepository $rep)
    {
        $data = $rep->find($id);
        $dataclection = array(
            'id' => $data->getId(),
            'datemodif' => $data->getDatemodif(),
            'prix' => $data->getPrix(),
            'remarque' => $data->getRemarque(),
            'ancienprix' => $data->getAncienprix(),
            'article' =>  array(
                'id' => $data->getArticle()->getId(),
                'libelle' => $data->getArticle()->getLibelle(),
                'prixencours' => $data->getArticle()->getPrixencours(),
                'unite' => $data->getArticle()->getUnite(),
                'codearticle' => $data->getArticle()->getCodearticle(),
                'description' => $data->getArticle()->getDescription(),
                'quincaillerie' => array(
                    'id' => $data->getArticle()->getQuincaillerie()->getId(),
                    'libellequic' => $data->getArticle()->getQuincaillerie()->getLibellequic(),
                    'codequinc' => $data->getArticle()->getQuincaillerie()->getCodequinc(),
                    'tel' => $data->getArticle()->getQuincaillerie()->getTel(),
                    'email' => $data->getArticle()->getQuincaillerie()->getEmail(),
                    'adresse' => $data->getArticle()->getQuincaillerie()->getAdresse(),
                    'ville' => $data->getArticle()->getQuincaillerie()->getVille(),
                    'region' => $data->getArticle()->getQuincaillerie()->getRegion(),
                    'lat' => $data->getArticle()->getQuincaillerie()->getLat(),
                    'long' => $data->getArticle()->getQuincaillerie()->getLonge()
                ),
                'categorie' => array(
                    'id' => $data->getArticle()->getCategorie()->getId(),
                    'codecategorie' => $data->getArticle()->getCategorie()->getCodecategorie(),
                    'libelle' => $data->getArticle()->getCategorie()->getLibelle(),
                    'categorie' => array(
                        'id' => $data->getArticle()->getCategorie()->getCategorie()->getId(),
                        'codecategorie' => $data->getArticle()->getCategorie()->getCategorie()->getCodecategorie(),
                        'libelle' => $data->getArticle()->getCategorie()->getCategorie()->getLibelle(),
                        'categorie' => $data->getArticle()->getCategorie()->getCategorie()->getCategorie(),
                        'description' => $data->getArticle()->getCategorie()->getCategorie()->getDescription()
                    ),
                    'description' => $data->getArticle()->getCategorie()->getDescription()
                )
            )
        );
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/modifprix/add", name="modifprix_add", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(Request $request, QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                        ArticleRepository $repArt,EntityManagerInterface $emi,
                        ModifprixRepository $rep) : JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $modifprix = new Modifprix;
        // dd("gdfgdfg");
        $article = $repArt->find($data['article']);
        $modifprix->setArticle($article);
        $modifprix->setDatemodif(new DateTime());
        $modifprix->setPrix($data['prix']);
        $modifprix->setRemarque($data['remarque']);
        $modifprix->setAncienprix($data['ancienprix']);
        $emi->persist($modifprix);
        $emi->flush();
        return new JsonResponse(['status'=>'modififprix created'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/modifprix/update/{id<[0-9]+>}", name="modifprix_update", methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update(Request $request, QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                           ArticleRepository $repArt,EntityManagerInterface $emi,
                           int $id,ModifprixRepository $rep) : JsonResponse
    {
        // dd("fghjkl");
        $data = json_decode($request->getContent(), true);
        $modifprix = $rep->find($id);
        // dd("gdfgdfg");
        $article = $repArt->find($data['article']);
        $modifprix->setArticle($article);
        $modifprix->setDatemodif(new DateTime());
        $modifprix->setPrix($data['prix']);
        $modifprix->setRemarque($data['remarque']);
        $modifprix->setAncienprix($data['ancienprix']);
        $emi->persist($modifprix);
        $emi->flush();
        return new JsonResponse(['status'=>'mise a jour Avec succes'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/modifprix/deletes", name="modifprix_deletes", methods={"PATCH"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function deletes(Request $request,QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                           ArticleRepository $repArt,EntityManagerInterface $emi,
                           ModifprixRepository $rep)
    {
        $data = json_decode($request->getContent(), true);
        foreach($data as $id){
            $modifprix = $rep->find($id);
            $emi->remove($modifprix);
        }
        $emi->flush();
        return new JsonResponse(['status'=>'Suppressions de modifPrix'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/modifprix/delete/{id<[0-9]+>}", name="modifprix_delete", methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(Request $request,int $id,QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                           ArticleRepository $repArt,EntityManagerInterface $emi,
                           ModifprixRepository $rep)
    {
        $modifprix = $rep->find($id);
        // dd($modifprix);
        $emi->remove($modifprix);
        $emi->flush();
        return new JsonResponse(['status'=>'Suppression de '.$modifprix->getid()], Response::HTTP_CREATED);
    }
     /**
     * @Route("/modifprix/clones", name="modifprix_clones", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function clones(Request $request,QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                           ArticleRepository $repArt,EntityManagerInterface $emi,
                           ModifprixRepository $rep)
    {
        $data = json_decode($request->getContent(), true);
        foreach($data as $id){
            $categorie = clone $rep->find($id);
            $emi->persist($categorie);
        }
        $emi->flush();
        return new JsonResponse(['status'=>'clonage de reussi'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/modifprix/clone/{id<[0-9]+>}", name="modifprix_clone", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner(Request $request,int $id,QuincaillerieRepository $repquinc,CategorieRepository $repcat,
                           ArticleRepository $repArt,EntityManagerInterface $emi,
                           ModifprixRepository $rep)
    {
        $modifprix = $rep->find($id);
        $modifprixclone = clone $modifprix;
        $emi->persist($modifprixclone);
        $emi->flush();
        return new JsonResponse(['status'=>'clonage de '.$modifprix->getid()], Response::HTTP_CREATED);
    }
}
