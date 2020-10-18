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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuincaillerieController extends AbstractController
{
    /**
     * @Route("/quincaillerie/all", name="quincaillerie_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll(QuincaillerieRepository $rep,EntityManagerInterface $emi)
    {
        $data = $rep->findAll();
        // return $this->json($data);
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                'id' => $item->getId(),
                'libellequic' => $item->getLibellequic(),
                'codequinc' => $item->getCodequinc(),
                'tel' => $item->getTel(),
                'email' => $item->getEmail(),
                'adresse' => $item->getAdresse(),
                'ville' => $item->getVille(),
                'region' => $item->getRegion(),
                'lat' => $item->getLat(),
                'long' => $item->getLonge()
            );
        }
        return new JsonResponse($dataclection);
    }
     /**
      * @Route("/quincaillerie/{id<[0-9]+>}", name="quincaillerie_one", methods={"GET"})
      * @param Requeste $requeste
      * @return JsonResponse
     */
    public function getOne(int $id, QuincaillerieRepository $rep)
    {
        // dd("dgfhjkl");
        $data = $rep->find($id);
        // return $this->json($data);
        $dataclection = array(
            'id' => $data->getId(),
            'libellequic' => $data->getLibellequic(),
            'codequinc' => $data->getCodequinc(),
            'tel' => $data->getTel(),
            'email' => $data->getEmail(),
            'adresse' => $data->getAdresse(),
            'ville' => $data->getVille(),
            'region' => $data->getRegion(),
            'lat' => $data->getLat(),
            'long' => $data->getLonge()
        );
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/quincaillerie/add", name="quincaillerie_add", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(Request $request,QuincaillerieRepository $rep,EntityManagerInterface $emi) : JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $quincaillerie = new Quincaillerie;
        // dd("gdfgdfg");
        $quincaillerie->setLibellequic($data['libellequic']);
        $quincaillerie->setCodequinc($data['codequinc']);
        $quincaillerie->setTel($data['tel']);
        $quincaillerie->setEmail($data['email']);
        $quincaillerie->setAdresse($data['adresse']);
        $quincaillerie->setVille($data['ville']);
        $quincaillerie->setRegion($data['region']);
        $quincaillerie->setLat($data['lat']);
        $quincaillerie->setLonge($data['long']);
        $emi->persist($quincaillerie);
        $emi->flush();
        return new JsonResponse(['status'=>'Quincaillerie created'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/quincaillerie/update/{id<[0-9]+>}", name="quincaillerie_update", methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update(int $id, Request $request,QuincaillerieRepository $rep,
                           EntityManagerInterface $emi) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $quincaillerie = $rep->find($id);
        // dd("gdfgdfg");
        $quincaillerie->setLibellequic($data['libellequic']);
        $quincaillerie->setCodequinc($data['codequinc']);
        $quincaillerie->setTel($data['tel']);
        $quincaillerie->setEmail($data['email']);
        $quincaillerie->setAdresse($data['adresse']);
        $quincaillerie->setVille($data['ville']);
        $quincaillerie->setRegion($data['region']);
        $quincaillerie->setLat($data['lat']);
        $quincaillerie->setLonge($data['long']);
        $emi->persist($quincaillerie);
        $emi->flush();
        return new JsonResponse(['status'=>'mise a jour Avec succes'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/quincaillerie/deletes", name="quincaillerie_deletes", methods={"PATCH"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function deletes(Request $request,QuincaillerieRepository $rep,EntityManagerInterface $emi):JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        foreach($data as $id){
            $quincaillerie = $rep->find($id);
            $emi->remove($quincaillerie);
        }
        $emi->flush();
        return new JsonResponse(['status'=>'Suppression des quincailleries'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/quincaillerie/delete/{id<[0-9]+>}", name="quincaillerie_delete", methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete( int $id, Request $request,QuincaillerieRepository $rep,
                            EntityManagerInterface $emi)
    {
        $quincaillerie = $rep->find($id);
        // dd($quincaillerie);
        $emi->remove($quincaillerie);
        $emi->flush();
        return new JsonResponse(['status'=>'Suppression de '.$quincaillerie->getid()], Response::HTTP_CREATED);
    }
     /**
     * @Route("/quincaillerie/clones", name="quincaillerie_clones", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function clones(Request $request,QuincaillerieRepository $rep,
                            EntityManagerInterface $emi)
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
     * @Route("/quincaillerie/clone/{id<[0-9]+>}", name="quincaillerie_clone", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function cloner( int $id, Request $request,QuincaillerieRepository $rep,
                            EntityManagerInterface $emi)
    {
        $quincaillerie = $rep->find($id);
        $quincaillerieclone = clone $quincaillerie;
        $emi->persist($quincaillerieclone);
        $emi->flush();
        return new JsonResponse(['status'=>'clonage de '.$quincaillerie->getid()], Response::HTTP_CREATED);
    }
}
