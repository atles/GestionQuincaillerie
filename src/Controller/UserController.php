<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\GroupeRepository;
use App\Repository\QuincaillerieRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
         /**
     * @Route("/user/all", name="user_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll( QuincaillerieRepository $repquinc,
                            GroupeRepository $repgrp,UserRepository $rep){
        $data = $rep->findAll();
        // return $this->json($data);
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                'id' => $item->getId(),
                'email' => $item->getEmail(),
                'user' => $item->getUser(),
                'tel' => $item->getTel(),
                'quincaillerie_id' => array(
                    'id'=>$item->getQuincaillerieId()->getId(),
                    'libellequic' =>$item->getQuincaillerieId()->getLibellequic(),
                    'codequinc' => $item->getQuincaillerieId()->getCodequinc(),
                    'email' => $item->getQuincaillerieId()->getEmail(),
                    'tel' => $item->getQuincaillerieId()->getTel(),
                    'adresse' => $item->getQuincaillerieId()->getAdresse(),
                    'ville' => $item->getQuincaillerieId()->getVille(),
                    'region' => $item->getQuincaillerieId()->getRegion(),
                    'lat' => $item->getQuincaillerieId()->getLat(),
                    'long' => $item->getQuincaillerieId()->getLonge()
                ),
                'groupe_id' => array(
                    'id' => $item->getGroupeId()->getId(),
                    'codegroupe' => $item->getGroupeId()->getCodegroupe(),
                    'libellegroupe' => $item->getGroupeId()->getLibellegroupe()
                )
            );
        }
        return new JsonResponse($dataclection);
    }
        /**
     * @Route("/user/{id<[0-9]+>}", name="user_one",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getOne(int $id, QuincaillerieRepository $repquinc,
                            GroupeRepository $repgrp,UserRepository $rep){
        // dd("ref");
        // return $this->json($rep->find($id));
        $data = $rep->find($id);
        $dataclection = array(
            'id' => $data->getId(),
            'email' => $data->getEmail(),
            'user' => $data->getUser(),
            'tel' => $data->getTel(),
            'quincaillerie_id' => array(
                'id'=>$data->getQuincaillerieId()->getId(),
                'libellequic' =>$data->getQuincaillerieId()->getLibellequic(),
                'codequinc' => $data->getQuincaillerieId()->getCodequinc(),
                'email' => $data->getQuincaillerieId()->getEmail(),
                'tel' => $data->getQuincaillerieId()->getTel(),
                'adresse' => $data->getQuincaillerieId()->getAdresse(),
                'ville' => $data->getQuincaillerieId()->getVille(),
                'region' => $data->getQuincaillerieId()->getRegion(),
                'lat' => $data->getQuincaillerieId()->getLat(),
                'long' => $data->getQuincaillerieId()->getLonge()
            ),
            'groupe_id' => array(
                'id' => $data->getGroupeId()->getId(),
                'codegroupe' => $data->getGroupeId()->getCodegroupe(),
                'libellegroupe' => $data->getGroupeId()->getLibellegroupe()
            )
        );
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/user/add", name="user_add", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(EntityManagerInterface $emi,QuincaillerieRepository $repquinc,
                        GroupeRepository $repgrp,Request $request) : JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $user = new User;
        $grp = $repgrp->find($data['groupe']);
        $quinc = $repquinc->find($data['quincaillerie']);
        $user->setGroupeId($grp);
        $user->setQuincaillerieId($quinc);
        $user->setUser($data['user']);
        $user->setEmail($data['email']);
        $user->setTel($data['tel']);
        $emi->persist($user);
        $emi->flush();

        return new JsonResponse(['status'=>'User created'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/user/update/{id<[0-9]+>}", name="user_update", methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update(int $id,EntityManagerInterface $emi,QuincaillerieRepository $repquinc,
                           GroupeRepository $repgrp,Request $request,UserRepository $rep) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $rep->find($id);
        $grp = $repgrp->find($data['groupe']);
        $quinc = $repquinc->find($data['quincaillerie']);
        $user->setGroupeId($grp);
        $user->setQuincaillerieId($quinc);
        $user->setUser($data['user']);
        $user->setEmail($data['email']);
        $user->setTel($data['tel']);
        $emi->persist($user);
        $emi->flush();
        return new JsonResponse(['status'=>'mise a jour Avec succes'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/user/delete/{id<[0-9]+>}", name="user_delete", methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(int $id,EntityManagerInterface $emi,QuincaillerieRepository $repquinc,
                           GroupeRepository $repgrp,Request $request,UserRepository $rep)
    {
        $user = $rep->find($id);
        $emi->remove($user);
        $emi->flush();
        return new JsonResponse(['status'=>'Suppression de '.$user->getid()], Response::HTTP_CREATED);
    }
     /**
     * @Route("/user/clone/{id<[0-9]+>}", name="user_clone", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner(int $id,EntityManagerInterface $emi,QuincaillerieRepository $repquinc,
                           GroupeRepository $repgrp,Request $request,UserRepository $rep)
    {
        $user = $rep->find($id);
        $userclone = clone $user;
        $emi->persist($userclone);
        $emi->flush();
        return new JsonResponse(['status'=>'Clonage de '.$user->getid()], Response::HTTP_CREATED);
    }
}
