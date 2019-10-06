<?php

namespace App\Controller;

use App\Entity\ImobiliariaAtuacao;
use App\Entity\Cidade;
use App\Form\ImobiliariaAtuacaoType;
use App\Repository\ImobiliariaAtuacaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/imobiliaria-atuacao")
 */
class ImobiliariaAtuacaoController extends AbstractController
{
    /**
     * @Route("/", name="imobiliaria_atuacao_index", methods={"GET"})
     */
    public function index(ImobiliariaAtuacaoRepository $imobiliariaAtuacaoRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $page = $request->query->getInt('page',1);

        $imoveis = $imobiliariaAtuacaoRepository->findAll();

        $imoveis = $paginator->paginate($imoveis, $page, 15);

        return $this->render('imobiliaria_atuacao/index.html.twig', [
            'imobiliaria_atuacaos' => $imoveis,
        ]);
    }

    /**
     * @Route("/new", name="imobiliaria_atuacao_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $imobiliariaAtuacao = new ImobiliariaAtuacao();
        $form = $this->createForm(ImobiliariaAtuacaoType::class, $imobiliariaAtuacao);
        
        try{

            if ($request->isMethod('POST')) {

                $form->handleRequest($request);

                $cidadeId = $request->request->get('imobiliaria_atuacao')['fkCidadeId'];
                $imobiliariaAtuacao->setFkCidadeId( $entityManager->getRepository(Cidade::class)->findOneById($cidadeId) );

                $entityManager->persist($imobiliariaAtuacao);
                $entityManager->flush();

                return $this->redirectToRoute('imobiliaria_atuacao_index');

            }
        }catch (\Exception $e){
            throw new Exception($e->getMessage());
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
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ImobiliariaAtuacaoType::class, $imobiliariaAtuacao);
        
        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            try{

                $em->merge($imobiliariaAtuacao);
	    		$em->flush();
                return $this->redirectToRoute('imobiliaria_atuacao_index');

            }catch (\Exception $e){
                throw new Exception($e->getMessage());
            }

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
