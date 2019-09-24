<?php

namespace App\Controller;

use App\Entity\ImobiliariaAtuacao;
use App\Form\ImobiliariaAtuacaoType;
use App\Repository\ImobiliariaAtuacaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/imobiliaria-atuacao")
 */
class ImobiliariaAtuacaoController extends AbstractController
{
    /**
     * @Route("/", name="imobiliaria_atuacao_index", methods={"GET"})
     */
    public function index(ImobiliariaAtuacaoRepository $imobiliariaAtuacaoRepository): Response
    {
        return $this->render('imobiliaria_atuacao/index.html.twig', [
            'imobiliaria_atuacaos' => $imobiliariaAtuacaoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="imobiliaria_atuacao_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $imobiliariaAtuacao = new ImobiliariaAtuacao();
        $form = $this->createForm(ImobiliariaAtuacaoType::class, $imobiliariaAtuacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imobiliariaAtuacao);
            $entityManager->flush();

            return $this->redirectToRoute('imobiliaria_atuacao_index');
        }

        return $this->render('imobiliaria_atuacao/new.html.twig', [
            'imobiliaria_atuacao' => $imobiliariaAtuacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="imobiliaria_atuacao_show", methods={"GET"})
     */
    public function show(ImobiliariaAtuacao $imobiliariaAtuacao): Response
    {
        return $this->render('imobiliaria_atuacao/show.html.twig', [
            'imobiliaria_atuacao' => $imobiliariaAtuacao,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="imobiliaria_atuacao_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ImobiliariaAtuacao $imobiliariaAtuacao): Response
    {
        $form = $this->createForm(ImobiliariaAtuacaoType::class, $imobiliariaAtuacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('imobiliaria_atuacao_index');
        }

        return $this->render('imobiliaria_atuacao/edit.html.twig', [
            'imobiliaria_atuacao' => $imobiliariaAtuacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="imobiliaria_atuacao_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ImobiliariaAtuacao $imobiliariaAtuacao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imobiliariaAtuacao->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($imobiliariaAtuacao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('imobiliaria_atuacao_index');
    }
}
