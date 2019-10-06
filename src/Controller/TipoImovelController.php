<?php

namespace App\Controller;

use App\Entity\TipoImovel;
use App\Form\TipoImovelType;
use App\Repository\TipoImovelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/tipo-imovel")
 */
class TipoImovelController extends AbstractController
{
    /**
     * @Route("/", name="tipo_imovel_index", methods={"GET"})
     */
    public function index(TipoImovelRepository $tipoImovelRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $page = $request->query->getInt('page',1);

        $tipo = $tipoImovelRepository->findAll();

        $tipo = $paginator->paginate($tipo, $page, 15);

        return $this->render('tipo_imovel/index.html.twig', [
            'tipo_imovels' => $tipo,
        ]);
    }

    /**
     * @Route("/new", name="tipo_imovel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoImovel = new TipoImovel();
        $form = $this->createForm(TipoImovelType::class, $tipoImovel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoImovel);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_imovel_index');
        }

        return $this->render('tipo_imovel/new.html.twig', [
            'tipo_imovel' => $tipoImovel,
            'form' => $form->createView(),
        ]);
    }

    // /**
    //  * @Route("/{id}", name="tipo_imovel_show", methods={"GET"})
    //  */
    // public function show(TipoImovel $tipoImovel): Response
    // {
    //     return $this->render('tipo_imovel/show.html.twig', [
    //         'tipo_imovel' => $tipoImovel,
    //     ]);
    // }

    /**
     * @Route("/{id}/edit", name="tipo_imovel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoImovel $tipoImovel): Response
    {
        $form = $this->createForm(TipoImovelType::class, $tipoImovel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_imovel_index');
        }

        return $this->render('tipo_imovel/edit.html.twig', [
            'tipo_imovel' => $tipoImovel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_imovel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoImovel $tipoImovel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoImovel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoImovel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_imovel_index');
    }
}
