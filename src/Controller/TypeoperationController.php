<?php

namespace App\Controller;

use App\Entity\Typeoperation;
use App\Repository\TypeoperationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeoperationController extends AbstractController
{
    /**
     * @Route("/typeoperation", name="typeoperation")
     */
    public function index()
    {
        return $this->render('typeoperation/index.html.twig', [
            'controller_name' => 'TypeoperationController',
        ]);
    }

         /**
     * @Route("/typeoperation/all", name="typeoperation_all",methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getAll( TypeoperationRepository $rep ){
        // dd("ref");
        // return $this->json($rep->findAll());
        $data = $rep->findAll();
        // return $this->json($data);
        $dataclection = array();
        foreach($data as $item){
            $dataclection[] = array(
                'id' => $item->getId(),
                'typeoperation' => $item->getTypeoperation()
            );
        }
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/typeoperation/{id<[0-9]+>}", name="typeoperation_one", methods={"GET"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function getOne(int $id,TypeoperationRepository $rep)
    {
        $data = $rep->find($id);
        // return $this->json($data);
        $dataclection = array(
            'id' => $data->getId(),
            'typeoperation' => $data->getTypeoperation()
        );
        return new JsonResponse($dataclection);
    }
     /**
     * @Route("/typeoperation/add", name="typeoperation_add", methods={"POST"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function add(Request $request,EntityManagerInterface $emi) : JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $typeOp = new Typeoperation;
        $typeOp->setTypeoperation($data['typeoperation']);
        $emi->persist($typeOp);
        $emi->flush();
        return new JsonResponse(['status'=>'TypeOperation created'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/typeoperation/update/{id<[0-9]+>}", name="typeoperation_update", methods={"PUT"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function update( Request $request,EntityManagerInterface $emi,
                            TypeoperationRepository $rep,int $id) : JsonResponse
    {
        // dd("fghjkl");
        $data = json_decode($request->getContent(), true);
        $typeOp = $rep->find($id);
        $typeOp->setTypeoperation($data['typeoperation']);
        $emi->persist($typeOp);
        $emi->flush();
        return new JsonResponse(['status'=>'mise a jour Avec succes'], Response::HTTP_CREATED);
    }
     /**
     * @Route("/typeoperation/delete/{id<[0-9]+>}", name="typeoperation_delete", methods={"DELETE"})
     * @param Requeste $requeste
     * @return JsonResponse
     */
    public function delete( Request $request,EntityManagerInterface $emi,
                            TypeoperationRepository $rep,int $id)
    {
        $typeOp = $rep->find($id);
        // dd($typeOp);
        $emi->remove($typeOp);
        $emi->flush();
        return new JsonResponse(['status'=>'Suppression de '.$typeOp->getid()], Response::HTTP_CREATED);
    }

}
