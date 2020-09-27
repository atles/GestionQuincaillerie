<?php

namespace App\Controller;

use App\Entity\Lignecommande;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
use App\Repository\LignecommandeRepository;
use App\Repository\QuincaillerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LigneCommandeController extends AbstractController
{
    /**
     * @Route("/ligne/commande", name="ligne_commande")
     */
    public function index()
    {
        return $this->render('ligne_commande/index.html.twig', [
            'controller_name' => 'LigneCommandeController',
        ]);
    }
    /**
     * @Route("/ligne/commande/all", name="ligne_commande_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll(QuincaillerieRepository $repquinc,CategorieRepository $repcat, 
                            CommandeRepository $repcom, ArticleRepository $repart, 
                                LignecommandeRepository $rep)
    {
        $data = $rep->findAll();
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                "id" =>$item->getId(),
                "pu" =>$item->getPu(),
                "qte" =>$item->getQte(),
                "unit" =>$item->getUnit(),
                "commande" => array(
                    "id" => $item->getCommande()->getId(),
                    "datecommande" => $item->getCommande()->getDatecommande(),
                    "designation" => $item->getCommande()->getDesignation(),
                    "montant" => $item->getCommande()->getMontant(),
                    "numfacture" => $item->getCommande()->getNumfacture(),
                    "description" => $item->getCommande()->getDescription()
                ),
                "article" => array(
                    "id" => $item->getArticle()->getId(),
                    "libelle" => $item->getArticle()->getLibelle(),
                    "prixencours" => $item->getArticle()->getPrixencours(),
                    "unit" => $item->getArticle()->getUnite(),
                    "codearticle" => $item->getArticle()->getCodearticle(),
                    "description" => $item->getArticle()->getDescription(),
                    "quincaillerie" => array(
                        "id" => $item->getArticle()->getQuincaillerie()->getId(),
                        "libellequic" => $item->getArticle()->getQuincaillerie()->getLibellequic(),
                        "codequinc" => $item->getArticle()->getQuincaillerie()->getCodequinc(),
                        "email" => $item->getArticle()->getQuincaillerie()->getEmail(),
                        "tel" => $item->getArticle()->getQuincaillerie()->getTel(),
                        "adresse" => $item->getArticle()->getQuincaillerie()->getAdresse(),
                        "ville" => $item->getArticle()->getQuincaillerie()->getVille(),
                        "region" => $item->getArticle()->getQuincaillerie()->getRegion(),
                        "longe" => $item->getArticle()->getQuincaillerie()->getLonge(),
                        "lat" => $item->getArticle()->getQuincaillerie()->getLat()
                    ),
                    "categorie" => array(
                        "id" => $item->getArticle()->getCategorie()->getId(),
                        "codecategorie" => $item->getArticle()->getCategorie()->getCodecategorie(),
                        "libelle" => $item->getArticle()->getCategorie()->getLibelle(),
                        "categorie" => $item->getArticle()->getCategorie()->getCategorie(),
                        "description" => $item->getArticle()->getCategorie()->getDescription()
                    )
                )
            );
        }
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/ligne/commande/{id<[0-9]+>}", name="ligne_commande_one",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getOne(QuincaillerieRepository $repquinc,CategorieRepository $repcat, 
                             CommandeRepository $repcom, ArticleRepository $repart, 
                                LignecommandeRepository $rep, int $id)
    {
        $data = $rep->find($id);
            $dataclection = array(
                "id" =>$data->getId(),
                "pu" =>$data->getPu(),
                "qte" =>$data->getQte(),
                "unit" =>$data->getUnit(),
                "commande" => array(
                    "id" => $data->getCommande()->getId(),
                    "datecommande" => $data->getCommande()->getDatecommande(),
                    "designation" => $data->getCommande()->getDesignation(),
                    "montant" => $data->getCommande()->getMontant(),
                    "numfacture" => $data->getCommande()->getNumfacture(),
                    "description" => $data->getCommande()->getDescription()
                ),
                "article" => array(
                    "id" => $data->getArticle()->getId(),
                    "libelle" => $data->getArticle()->getLibelle(),
                    "prixencours" => $data->getArticle()->getPrixencours(),
                    "unit" => $data->getArticle()->getUnite(),
                    "codearticle" => $data->getArticle()->getCodearticle(),
                    "description" => $data->getArticle()->getDescription(),
                    "quincaillerie" => array(
                        "id" => $data->getArticle()->getQuincaillerie()->getId(),
                        "libellequic" => $data->getArticle()->getQuincaillerie()->getLibellequic(),
                        "codequinc" => $data->getArticle()->getQuincaillerie()->getCodequinc(),
                        "email" => $data->getArticle()->getQuincaillerie()->getEmail(),
                        "tel" => $data->getArticle()->getQuincaillerie()->getTel(),
                        "adresse" => $data->getArticle()->getQuincaillerie()->getAdresse(),
                        "ville" => $data->getArticle()->getQuincaillerie()->getVille(),
                        "region" => $data->getArticle()->getQuincaillerie()->getRegion(),
                        "longe" => $data->getArticle()->getQuincaillerie()->getLonge(),
                        "lat" => $data->getArticle()->getQuincaillerie()->getLat()
                    ),
                    "categorie" => array(
                        "id" => $data->getArticle()->getCategorie()->getId(),
                        "codecategorie" => $data->getArticle()->getCategorie()->getCodecategorie(),
                        "libelle" => $data->getArticle()->getCategorie()->getLibelle(),
                        "categorie" => $data->getArticle()->getCategorie()->getCategorie(),
                        "description" => $data->getArticle()->getCategorie()->getDescription()
                    )
                )
            );
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/ligne/commande/add", name="ligne_commande_add",methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(EntityManagerInterface $emi,CommandeRepository $repcom,
                         QuincaillerieRepository $repquinc,CategorieRepository $repcat, 
                            ArticleRepository $repart, Request $request) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $ligncommande = new Lignecommande;
        $ligncommande->setPu($data['pu']);
        $ligncommande->setQte($data['qte']);
        $ligncommande->setUnit($data['unit']);
        $commande = $repcom->find($data['commande']);
        $article = $repart->find($data['article']);
        $ligncommande->setCommande($commande);
        $ligncommande->setArticle($article);
        $emi->persist($ligncommande);
        $emi->flush();
        return new JsonResponse(['status'=>'Lignecommande created'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/ligne/commande/update/{id<[0-9]+>}", name="ligne_commande_update",methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update(EntityManagerInterface $emi,CommandeRepository $repcom,
                            QuincaillerieRepository $repquinc,CategorieRepository $repcat, 
                                ArticleRepository $repart, Request $request, int $id, 
                                    LignecommandeRepository $rep) : JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $ligncommande = $rep->find($id);
        $ligncommande->setPu($data['pu']);
        $ligncommande->setQte($data['qte']);
        $ligncommande->setUnit($data['unit']);
        $commande = $repcom->find($data['commande']);
        $article = $repart->find($data['article']);
        $ligncommande->setCommande($commande);
        $ligncommande->setArticle($article);
        $emi->persist($ligncommande);
        $emi->flush();
        return new JsonResponse(['status'=>'Lignecommande mise a jour'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/ligne/commande/delete/{id<[0-9]+>}", name="ligne_commande_delete",methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(EntityManagerInterface $emi,CommandeRepository $repcom,
                            QuincaillerieRepository $repquinc,CategorieRepository $repcat, 
                                ArticleRepository $repart,int $id, LignecommandeRepository $rep) : JsonResponse
    {
        $lignecommande = $rep->find($id);
        $emi->remove($lignecommande);
        $emi->flush();
        return new JsonResponse(['status'=>'Lignecommande supprimer'], Response::HTTP_CREATED);
    }
}
