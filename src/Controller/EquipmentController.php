<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipments")
 */
class EquipmentController extends AbstractController
{
    /**
     * @Route("/", name="equipment_index", methods={"GET"})
     */
    public function getEquipments(EquipmentRepository $equipmentRepository): Response
    {
        return $this->render('equipment/index.html.twig', [
            'equipment' => $equipmentRepository->findBy([],['createdAt' => 'desc']),
        ]);
    }

    /**
     * @Route("/add", name="equipment_add", methods={"GET", "POST"})
     */
    public function postEquipment(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $this->get('session');
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $entityManager->persist($equipment);
                $entityManager->flush();
            }
            catch (\Exception $ex) {
                $session->getFlashBag()->add('danger',$ex->getMessage());
            }

            return $this->redirectToRoute('equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipment/new.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_show", methods={"GET"})
     */
    public function getEquipment(Equipment $equipment): Response
    {
        return $this->render('equipment/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="equipment_edit", methods={"GET", "POST"})
     */
    public function putEquipment(Request $request, Equipment $equipment, EntityManagerInterface $entityManager): Response
    {
        $session = $this->get('session');
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $entityManager->flush();
            }
            catch (\Exception $ex) {
                $session->getFlashBag()->add('danger',$ex->getMessage());
            }

            return $this->redirectToRoute('equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipment/edit.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_delete", methods={"POST"})
     */
    public function deleteEquipment(Request $request, Equipment $equipment, EntityManagerInterface $entityManager): Response
    {
        $session = $this->get('session');
        if ($this->isCsrfTokenValid('delete'.$equipment->getId(), $request->request->get('_token'))) {
            try{
                $entityManager->remove($equipment);
                $entityManager->flush();
            }
            catch (\Exception $ex) {
                $session->getFlashBag()->add('danger',$ex->getMessage());
            }
        }

        return $this->redirectToRoute('equipment_index', [], Response::HTTP_SEE_OTHER);
    }
}
