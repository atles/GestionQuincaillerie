<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Repository\GroupeRepository;
use App\Repository\QuincaillerieRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index()
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
    /**
     * @Route("/client/all", name="client_all", methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll(QuincaillerieRepository $repquinc, GroupeRepository $repgrp,
                            UserRepository $repuser,ClientRepository $rep){
        $data = $rep->findAll();
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                "id" => $item->getId(),
                "typeclient" => $item->getTypeclient(),
                "prenom" => $item->getPrenom(),
                "nom" => $item->getNom(),
                "adresse" => $item->getAdresse(),
                "email" => $item->getEmail(),
                "tel" => $item->getTel(),
                "acompte" => $item->getAcompte(),
                "photo" => $item->getPhoto(),
                "profession" => $item->getProfession(),
                "solde" => $item->getSolde(),
                "user" => array(
                    "id" => $item->getUser()->getId(),
                    "user" => $item->getUser()->getUser(),
                    "email" => $item->getUser()->getEmail(),
                    "tel" => $item->getUser()->getTel(),
                    "quincaillerie_id" => array(
                        "id" => $item->getUser()->getQuincaillerieId()->getId(),
                        'libellequic' => $item->getUser()->getQuincaillerieId()->getLibellequic(),
                        'codequinc' => $item->getUser()->getQuincaillerieId()->getCodequinc(),
                        'tel' => $item->getUser()->getQuincaillerieId()->getTel(),
                        'email' => $item->getUser()->getQuincaillerieId()->getEmail(),
                        'adresse' => $item->getUser()->getQuincaillerieId()->getAdresse(),
                        'ville' => $item->getUser()->getQuincaillerieId()->getVille(),
                        'region' => $item->getUser()->getQuincaillerieId()->getRegion(),
                        'lat' => $item->getUser()->getQuincaillerieId()->getLat(),
                        'long' => $item->getUser()->getQuincaillerieId()->getLonge()
                    ),
                    "groupe_id" => array(
                        "id" => $item->getUser()->getGroupeId()->getId(),
                        "codegroupe" => $item->getUser()->getGroupeId()->getCodegroupe(),
                        "libellegroupe" => $item->getUser()->getGroupeId()->getLibellegroupe(),
                    )
                )
            );
        }
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/client/{id<[0-9]+>}", name="client_one", methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getOne(QuincaillerieRepository $repquinc, GroupeRepository $repgrp,
                            UserRepository $repuser,ClientRepository $rep,int $id){
        $data = $rep->find($id);
        $dataclection = array(
            "id" => $data->getId(),
            "typeclient" => $data->getTypeclient(),
            "prenom" => $data->getPrenom(),
            "nom" => $data->getNom(),
            "adresse" => $data->getAdresse(),
            "email" => $data->getEmail(),
            "tel" => $data->getTel(),
            "acompte" => $data->getAcompte(),
            "photo" => $data->getPhoto(),
            "profession" => $data->getProfession(),
            "solde" => $data->getSolde(),
            "user" => array(
                "id" => $data->getUser()->getId(),
                "user" => $data->getUser()->getUser(),
                "email" => $data->getUser()->getEmail(),
                "tel" => $data->getUser()->getTel(),
                "quincaillerie_id" => array(
                    "id" => $data->getUser()->getQuincaillerieId()->getId(),
                    'libellequic' => $data->getUser()->getQuincaillerieId()->getLibellequic(),
                    'codequinc' => $data->getUser()->getQuincaillerieId()->getCodequinc(),
                    'tel' => $data->getUser()->getQuincaillerieId()->getTel(),
                    'email' => $data->getUser()->getQuincaillerieId()->getEmail(),
                    'adresse' => $data->getUser()->getQuincaillerieId()->getAdresse(),
                    'ville' => $data->getUser()->getQuincaillerieId()->getVille(),
                    'region' => $data->getUser()->getQuincaillerieId()->getRegion(),
                    'lat' => $data->getUser()->getQuincaillerieId()->getLat(),
                    'long' => $data->getUser()->getQuincaillerieId()->getLonge()
                ),
                "groupe_id" => array(
                    "id" => $data->getUser()->getGroupeId()->getId(),
                    "codegroupe" => $data->getUser()->getGroupeId()->getCodegroupe(),
                    "libellegroupe" => $data->getUser()->getGroupeId()->getLibellegroupe(),
                )
            )
        );
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/client/add", name="client_add", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(QuincaillerieRepository $repquinc, GroupeRepository $repgrp,
                            UserRepository $repuser,ClientRepository $rep, Request $request,
                            EntityManagerInterface $emi) : JsonResponse{
        $data = json_decode($request->getContent(), true);
        $client = new Client;
        $user = $repuser->find($data['user']);
        $client->setTypeclient($data['typeclient']);
        $client->setPrenom($data['prenom']);
        $client->setNom($data['nom']);
        $client->setAdresse($data['adresse']);
        $client->setEmail($data['email']);
        $client->setTel($data['tel']);
        $client->setAcompte($data['acompte']);
        $client->setPhoto($data['photo']);
        $client->setProfession($data['profession']);
        $client->setSolde($data['solde']);
        $client->setUser($user);
        $emi->persist($client);
        $emi->flush();
        return new JsonResponse(['status'=>'Client created'], Response::HTTP_CREATED);
    }
    
    /**
     * @Route("/client/update/{id<[0-9]+>}", name="client_update", methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update(QuincaillerieRepository $repquinc, GroupeRepository $repgrp,
                            UserRepository $repuser,ClientRepository $rep, Request $request,
                            EntityManagerInterface $emi,int $id) : JsonResponse{
        $data = json_decode($request->getContent(), true);
        $client = $rep->find($id);
        $user = $repuser->find($data['user']);
        $client->setTypeclient($data['typeclient']);
        $client->setPrenom($data['prenom']);
        $client->setNom($data['nom']);
        $client->setAdresse($data['adresse']);
        $client->setEmail($data['email']);
        $client->setTel($data['tel']);
        $client->setAcompte($data['acompte']);
        $client->setPhoto($data['photo']);
        $client->setProfession($data['profession']);
        $client->setSolde($data['solde']);
        $client->setUser($user);
        $emi->persist($client);
        $emi->flush();
        return new JsonResponse(['status'=>'Client modifier'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/client/delete/{id<[0-9]+>}", name="client_delete", methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(QuincaillerieRepository $repquinc, GroupeRepository $repgrp,
                            UserRepository $repuser,ClientRepository $rep,
                            EntityManagerInterface $emi,int $id) : JsonResponse{

        $client = $rep->find($id);
        $emi->remove($client);
        $emi->flush();

        return new JsonResponse(['status'=>'Client supprimer'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/client/clone/{id<[0-9]+>}", name="client_clone", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner(QuincaillerieRepository $repquinc, GroupeRepository $repgrp,
                            UserRepository $repuser,ClientRepository $rep,
                            EntityManagerInterface $emi,int $id) : JsonResponse{

        $client = $rep->find($id);
        $clientclone = clone $client;
        $emi->persist($clientclone);
        $emi->flush();

        return new JsonResponse(['status'=>'Client cloner avec success'], Response::HTTP_CREATED);
    }
}
