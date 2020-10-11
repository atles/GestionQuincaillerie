<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index()
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    /**
     * @Route("/commande/all", name="commande_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll(CommandeRepository $rep){
        $data = $rep->findAll();
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                "id" => $item->getId(),
                "datecommande" => $item->getDatecommande(),
                "designation" => $item->getDesignation(),
                "montant" => $item->getMontant(),
                "numfacture" => $item->getNumfacture(),
                "description" => $item->getDescription()
            );
        }
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/commande/{id<[0-9]+>}", name="commande_one",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getOne(int $id, CommandeRepository $rep){
        $data = $rep->find($id);
            $dataclection = array(
                "id" => $data->getId(),
                "datecommande" => $data->getDatecommande(),
                "designation" => $data->getDesignation(),
                "montant" => $data->getMontant(),
                "numfacture" => $data->getNumfacture(),
                "description" => $data->getDescription()
            );
        return new JsonResponse($dataclection);
    }
    /**
     * @Route("/commande/add", name="commande_add",methods={"POST","GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(EntityManagerInterface $emi, Request $request) : JsonResponse{
        $data = json_decode($request->getContent(), true);
        $commande = new Commande;
        $commande->setDatecommande(new DateTime($data['datecommande']));
        $commande->setDesignation($data['designation']);
        $commande->setMontant($data['montant']);
        $commande->setNumfacture($data['numfacture']);
        $commande->setDescription($data['description']);
        $emi->persist($commande);
        $emi->flush();
        return new JsonResponse(['status'=>'Commande created'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/commande/update/{id<[0-9]+>}", name="commande_update",methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update(int $id, EntityManagerInterface $emi, Request $request,CommandeRepository $rep) : JsonResponse{
        $data = json_decode($request->getContent(), true);
        $commande = $rep->find($id);
        $commande->setDatecommande(new DateTime($data['datecommande']));
        $commande->setDesignation($data['designation']);
        $commande->setMontant($data['montant']);
        $commande->setNumfacture($data['numfacture']);
        $commande->setDescription($data['description']);
        $emi->persist($commande);
        $emi->flush();
        return new JsonResponse(['status'=>'Commande mise a jour'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/commande/deletes", name="commande_deletes",methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function deletes(Request $request,CommandeRepository $rep, EntityManagerInterface $emi) : JsonResponse{
        $data = json_decode($request->getContent(), true);
        foreach($data as $id){
            $commande = $rep->find($id);
            $emi->remove($commande);
        }
        $emi->flush();
        return new JsonResponse(['status'=>'Commandes delete'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/commande/delete/{id<[0-9]+>}", name="commande_delete",methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete(int $id,CommandeRepository $rep, EntityManagerInterface $emi) : JsonResponse{

        $commande = $rep->find($id);
        $emi->remove($commande);
        $emi->flush();
        return new JsonResponse(['status'=>'Commande delete'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/commande/clone/{id<[0-9]+>}", name="commande_clone",methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner(int $id,CommandeRepository $rep, EntityManagerInterface $emi) : JsonResponse{

        $commande = $rep->find($id);
        $commandeclone = clone $commande;
        $emi->persist($commandeclone);
        $emi->flush();
        return new JsonResponse(['status'=>'Commande clone'], Response::HTTP_CREATED);
    }
}
