<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use App\Repository\GroupeRepository;
use App\Repository\LignecommandeRepository;
use App\Repository\OperationRepository;
use App\Repository\QuincaillerieRepository;
use App\Repository\TypeoperationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OperationController extends AbstractController
{
    /**
     * @Route("/operation", name="operation")
     */
    public function index()
    {
        return $this->render('operation/index.html.twig', [
            'controller_name' => 'OperationController',
        ]);
    }

    /**
     * @Route("/operation/all", name="operation_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll( QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                            UserRepository $repuser,CategorieRepository $repcat,
                            ArticleRepository $repArt,CommandeRepository $repcom,
                            LignecommandeRepository $replign,TypeoperationRepository $reptype,
                            ClientRepository $repcli,EntityManagerInterface $emi,
                            OperationRepository $rep)
    {
        $data = $rep->findAll();
        // return $this->json($data);
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                'id' => $item->getId(),
                'typeoperation' => array(
                    'id' => $item->getTypeoperation()->getId(),
                    'typeoperation' => $item->getTypeoperation()->getTypeoperation()
                ),
                'client' => array(
                    'id' => $item->getClient()->getId(),
                    'typeclient' => $item->getClient()->getTypeclient(),
                    'prenom' => $item->getClient()->getPrenom(),
                    'nom' => $item->getClient()->getNom(),
                    'adresse' => $item->getClient()->getAdresse(),
                    'email' => $item->getClient()->getEmail(),
                    'tel' => $item->getClient()->getTel(),
                    'acompte' => $item->getClient()->getAcompte(),
                    'photo' => $item->getClient()->getPhoto(),
                    'profession' => $item->getClient()->getProfession(),
                    'solde' => $item->getClient()->getSolde(),
                    'user' => array(
                        'user' => array(
                            'id' => $item->getClient()->getUser()->getId(),
                            'email' => $item->getClient()->getUser()->getUser(),
                            'tel' => $item->getClient()->getUser()->getTel(),
                            'quincaillerie_id' => array(
                                'id'=>$item->getClient()->getUser()->getQuincaillerieId()->getId(),
                                'libellequic' =>$item->getClient()->getUser()->getQuincaillerieId()->getLibellequic(),
                                'codequinc' => $item->getClient()->getUser()->getQuincaillerieId()->getCodequinc(),
                                'email' => $item->getClient()->getUser()->getQuincaillerieId()->getEmail(),
                                'tel' => $item->getClient()->getUser()->getQuincaillerieId()->getTel(),
                                'adresse' => $item->getClient()->getUser()->getQuincaillerieId()->getAdresse(),
                                'ville' => $item->getClient()->getUser()->getQuincaillerieId()->getVille(),
                                'region' => $item->getClient()->getUser()->getQuincaillerieId()->getRegion(),
                                'lat' => $item->getClient()->getUser()->getQuincaillerieId()->getLat(),
                                'long' => $item->getClient()->getUser()->getQuincaillerieId()->getLonge()
                            ),
                            'groupe_id' => array(
                                'id' => $item->getClient()->getUser()->getGroupeId()->getId(),
                                'codegroupe' => $item->getClient()->getUser()->getGroupeId()->getCodegroupe(),
                                'libellegroupe' => $item->getClient()->getUser()->getGroupeId()->getLibellegroupe()
                            )
                        )
                    )
                ),
                'lignecommande' => array(
                    'id' => $item->getLignecommande()->getId(),
                    'pu' => $item->getLignecommande()->getPu(),
                    'qte' => $item->getLignecommande()->getQte(),
                    'unit' => $item->getLignecommande()->getUnit(),
                    'commande' => array(
                        'id' => $item->getLignecommande()->getCommande()->getId(),
                        'datecommande' => $item->getLignecommande()->getCommande()->getDatecommande(),
                        'designation' => $item->getLignecommande()->getCommande()->getDesignation(),
                        'montant' => $item->getLignecommande()->getCommande()->getMontant(),
                        'numfature' => $item->getLignecommande()->getCommande()->getNumfacture(),
                        'description' => $item->getLignecommande()->getCommande()->getDescription()
                    ),
                    'article' => array(
                        'id' => $item->getLignecommande()->getArticle()->getId(),
                        'libelle' => $item->getLignecommande()->getArticle()->getLibelle(),
                        'prixencours' => $item->getLignecommande()->getArticle()->getPrixencours(),
                        'unite' => $item->getLignecommande()->getArticle()->getUnite(),
                        'codearticle' => $item->getLignecommande()->getArticle()->getCodearticle(),
                        'description' => $item->getLignecommande()->getArticle()->getDescription(),
                        'quincaillerie' => array(
                            'id' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getId(),
                            'libellequic' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getLibellequic(),
                            'codequinc' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getCodequinc(),
                            'tel' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getTel(),
                            'email' =>$item->getLignecommande()->getArticle()->getQuincaillerie()->getEmail(),
                            'adresse' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getAdresse(),
                            'ville' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getVille(),
                            'region' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getRegion(),
                            'lat' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getLat(),
                            'long' => $item->getLignecommande()->getArticle()->getQuincaillerie()->getLonge(),
                        'categorie' => array(
                            'id' => $item->getLignecommande()->getArticle()->getCategorie()->getId(),
                            'codecategorie' => $item->getLignecommande()->getArticle()->getCategorie()->getCodecategorie(),
                            'libelle' => $item->getLignecommande()->getArticle()->getCategorie()->getLibelle(),
                            'categorie' => array(
                                'id' => $item->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getId(),
                                'codecategorie' => $item->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getCodecategorie(),
                                'libelle' => $item->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getLibelle(),
                                'categorie' => $item->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getCategorie(),
                                'description' => $item->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getDescription()
                            ),
                            'description' => $item->getLignecommande()->getArticle()->getCategorie()->getDescription()
                        )
                    )
                )
            ) );
        }
        return new JsonResponse($dataclection);
    }
     /**
      * @Route("/operation/{id<[0-9]+>}", name="operation_one", methods={"GET"})
      * @param Requeste $requeste
      * @return JsonResponse
     */
    public function getOne( int $id,QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                            UserRepository $repuser,CategorieRepository $repcat,
                            ArticleRepository $repArt,CommandeRepository $repcom,
                            LignecommandeRepository $replign,TypeoperationRepository $reptype,
                            ClientRepository $repcli,EntityManagerInterface $emi,
                            OperationRepository $rep)
    {
        // dd("dgfhjkl");
        $data = $rep->find($id);

        $dataclection = array(
            'id' => $$data->getId(),
            'typeoperation' => $data->getTypeoperation(),
            'client' => array(
                'id' => $data->getClient()->getId(),
                'typeclient' => $data->getClient()->getTypeclient(),
                'prenom' => $data->getClient()->getPrenom(),
                'nom' => $data->getClient()->getNom(),
                'adresse' => $data->getClient()->getAdresse(),
                'email' => $data->getClient()->getEmail(),
                'tel' => $data->getClient()->getTel(),
                'acompte' => $data->getClient()->getAcompte(),
                'photo' => $data->getClient()->getPhoto(),
                'profession' => $data->getClient()->getProfession(),
                'solde' => $data->getClient()->getSolde(),
                'user' => array(
                    'user' => array(
                        'id' => $data->getClient()->getUser()->getId(),
                        'email' => $data->getClient()->getUser()->getUser(),
                        'tel' => $data->getClient()->getUser()->getTel(),
                        'quincaillerie_id' => array(
                            'id'=>$data->getClient()->getUser()->getQuincaillerieId()->getId(),
                            'libellequic' =>$data->getClient()->getUser()->getQuincaillerieId()->getLibellequic(),
                            'codequinc' => $data->getClient()->getUser()->getQuincaillerieId()->getCodequinc(),
                            'email' => $data->getClient()->getUser()->getQuincaillerieId()->getEmail(),
                            'tel' => $data->getClient()->getUser()->getQuincaillerieId()->getTel(),
                            'adresse' => $data->getClient()->getUser()->getQuincaillerieId()->getAdresse(),
                            'ville' => $data->getClient()->getUser()->getQuincaillerieId()->getVille(),
                            'region' => $data->getClient()->getUser()->getQuincaillerieId()->getRegion(),
                            'lat' => $data->getClient()->getUser()->getQuincaillerieId()->getLat(),
                            'long' => $data->getClient()->getUser()->getQuincaillerieId()->getLonge()
                        ),
                        'groupe_id' => array(
                            'id' => $data->getClient()->getUser()->getGroupeId()->getId(),
                            'codegroupe' => $data->getClient()->getUser()->getGroupeId()->getCodegroupe(),
                            'libellegroupe' => $data->getClient()->getUser()->getGroupeId()->getLibellegroupe()
                        )
                    )
                )
            ),
            'lignecommande' => array(
                'id' => $data->getLignecommande()->getId(),
                'pu' => $data->getLignecommande()->getPu(),
                'qte' => $data->getLignecommande()->getQte(),
                'unit' => $data->getLignecommande()->getUnit(),
                'commande' => array(
                    'id' => $data->getLignecommande()->getCommande()->getId(),
                    'datecommande' => $data->getLignecommande()->getCommande()->getDatecommande(),
                    'designation' => $data->getLignecommande()->getCommande()->getDesignation(),
                    'montant' => $data->getLignecommande()->getCommande()->getMontant(),
                    'numfature' => $data->getLignecommande()->getCommande()->getNumfacture(),
                    'description' => $data->getLignecommande()->getCommande()->getDescription()
                ),
                'article' => array(
                    'id' => $data->getLignecommande()->getArticle()->getId(),
                    'libelle' => $data->getLignecommande()->getArticle()->getLibelle(),
                    'prixencours' => $data->getLignecommande()->getArticle()->getPrixencours(),
                    'unite' => $data->getLignecommande()->getArticle()->getUnite(),
                    'codearticle' => $data->getLignecommande()->getArticle()->getCodearticle(),
                    'description' => $data->getLignecommande()->getArticle()->getDescription(),
                    'quincaillerie' => array(
                        'id' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getId(),
                        'libellequic' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getLibellequic(),
                        'codequinc' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getCodequinc(),
                        'tel' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getTel(),
                        'email' =>$data->getLignecommande()->getArticle()->getQuincaillerie()->getEmail(),
                        'adresse' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getAdresse(),
                        'ville' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getVille(),
                        'region' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getRegion(),
                        'lat' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getLat(),
                        'long' => $data->getLignecommande()->getArticle()->getQuincaillerie()->getLonge(),
                    'categorie' => array(
                        'id' => $data->getLignecommande()->getArticle()->getCategorie()->getId(),
                        'codecategorie' => $data->getLignecommande()->getArticle()->getCategorie()->getCodecategorie(),
                        'libelle' => $data->getLignecommande()->getArticle()->getCategorie()->getLibelle(),
                        'categorie' => array(
                            'id' => $data->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getId(),
                            'codecategorie' => $data->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getCodecategorie(),
                            'libelle' => $data->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getLibelle(),
                            'categorie' => $data->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getCategorie(),
                            'description' => $data->getLignecommande()->getArticle()->getCategorie()->getCategorie()->getDescription()
                        ),
                        'description' => $data->getLignecommande()->getArticle()->getCategorie()->getDescription()
                    )
                )
            )
        ) );


    }
     /**
     * @Route("/operation/add", name="operation_add", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                        UserRepository $repuser,CategorieRepository $repcat,
                        ArticleRepository $repArt,CommandeRepository $repcom,
                        LignecommandeRepository $replign,TypeoperationRepository $reptype,
                        ClientRepository $repcli,EntityManagerInterface $emi,
                        OperationRepository $rep,Request $request) : JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $operatipon = new Operation;
        // dd("gdfgdfg");
        $typeOp = $reptype->find($data['typeoperation']);
        $client = $repcli->find($data['client']);
        $lignecommande = $replign->find($data['lignecommande']);
        $operatipon->setTypeoperation($typeOp);
        $operatipon->setClient($client);
        $operatipon->setLignecommande($lignecommande);
        $emi->persist($operatipon);
        $emi->flush();
        return new JsonResponse(['status'=>'modififprix created'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/operation/update/{id<[0-9]+>}", name="operation_update", methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update( QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                            UserRepository $repuser,CategorieRepository $repcat,
                            ArticleRepository $repArt,CommandeRepository $repcom,
                            LignecommandeRepository $replign,TypeoperationRepository $reptype,
                            ClientRepository $repcli,EntityManagerInterface $emi,
                            int $id,OperationRepository $rep, Request $request) : JsonResponse
    {
        // dd("fghjkl");
        $data = json_decode($request->getContent(), true);
        $operatipon = $rep->find($id);
        // dd("gdfgdfg");
        $typeOp = $reptype->find($data['typeoperation']);
        $client = $repcli->find($data['client']);
        $lignecommande = $replign->find($data['lignecommande']);
        $operatipon->setTypeoperation($typeOp);
        $operatipon->setClient($client);
        $operatipon->setLignecommande($lignecommande);
        $emi->persist($operatipon);
        $emi->flush();
        return new JsonResponse(['status'=>'mise a jour Avec succes'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/operation/deletes", name="operation_deletes", methods={"PATCH"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function deletes( QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                            UserRepository $repuser,CategorieRepository $repcat,
                            ArticleRepository $repArt,CommandeRepository $repcom,
                            LignecommandeRepository $replign,TypeoperationRepository $reptype,
                            ClientRepository $repcli,EntityManagerInterface $emi,
                            OperationRepository $rep, Request $request):JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        foreach($data as $id){
            $operation = $rep->find($id);
            $emi->remove($operation);
        }
        $emi->flush();
        return new JsonResponse(['status'=>'Suppressions des operations'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/operation/delete/{id<[0-9]+>}", name="operation_delete", methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete( QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                            UserRepository $repuser,CategorieRepository $repcat,
                            ArticleRepository $repArt,CommandeRepository $repcom,
                            LignecommandeRepository $replign,TypeoperationRepository $reptype,
                            ClientRepository $repcli,EntityManagerInterface $emi,
                            int $id,OperationRepository $rep):JsonResponse
    {
        $operation = $rep->find($id);
        // dd($operation);
        $emi->remove($operation);
        $emi->flush();
        return new JsonResponse(['status'=>'Suppression de '.$operation->getid()], Response::HTTP_CREATED);
    }
     /**
     * @Route("/operation/clones", name="operation_clones", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function clones( QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                            UserRepository $repuser,CategorieRepository $repcat,
                            ArticleRepository $repArt,CommandeRepository $repcom,
                            LignecommandeRepository $replign,TypeoperationRepository $reptype,
                            ClientRepository $repcli,EntityManagerInterface $emi,
                            OperationRepository $rep, Request $request)
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
     * @Route("/operation/clone/{id<[0-9]+>}", name="operation_clone", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner( QuincaillerieRepository $repquin,GroupeRepository $repgrp,
                            UserRepository $repuser,CategorieRepository $repcat,
                            ArticleRepository $repArt,CommandeRepository $repcom,
                            LignecommandeRepository $replign,TypeoperationRepository $reptype,
                            ClientRepository $repcli,EntityManagerInterface $emi,
                            int $id,OperationRepository $rep, Request $request)
    {
        $operation = $rep->find($id);
        $operationclone = clone $operation;
        $emi->persist($operationclone);
        $emi->flush();
        return new JsonResponse(['status'=>'clonage de '.$operation->getid()], Response::HTTP_CREATED);
    }
}
