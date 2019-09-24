<?php

namespace App\Controller;

use App\Entity\Imovel;
use App\Form\ImovelType;
use App\Repository\ImovelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/imovel")
 */
class ImovelController extends AbstractController
{
    /**
     * @Route("/", name="imovel_index", methods={"GET"})
     */
    public function index(ImovelRepository $imovelRepository): Response
    {
        return $this->render('imovel/index.html.twig', [
            'imovels' => $imovelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="imovel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $imovel = new Imovel();
        $form = $this->createForm(ImovelType::class, $imovel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imovel);
            $entityManager->flush();

            return $this->redirectToRoute('imovel_index');
        }

        return $this->render('imovel/new.html.twig', [
            'imovel' => $imovel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="imovel_show", methods={"GET"})
     */
    public function show(Imovel $imovel): Response
    {
        return $this->render('imovel/show.html.twig', [
            'imovel' => $imovel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="imovel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Imovel $imovel): Response
    {
        $form = $this->createForm(ImovelType::class, $imovel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('imovel_index');
        }

        return $this->render('imovel/edit.html.twig', [
            'imovel' => $imovel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="imovel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Imovel $imovel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imovel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($imovel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('imovel_index');
    }
}
