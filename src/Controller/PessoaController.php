<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Entity\Estado;
use App\Entity\Cidade;
use App\Form\PessoaType;
use App\Repository\PessoaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/pessoa")
 */
class PessoaController extends AbstractController
{
    /**
     * @Route("/", name="pessoa_index", methods={"GET"})
     */
    public function index(PessoaRepository $pessoaRepository): Response
    {
        return $this->render('pessoa/index.html.twig', [
            'pessoas' => $pessoaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pessoa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pessoa = new Pessoa();
        $form = $this->createForm(PessoaType::class, $pessoa);

        try{

            if ($request->isMethod('POST')) {

                $form->handleRequest($request);

                $entityManager = $this->getDoctrine()->getManager();
                
                $pessoa->setPassword("");
                $pessoa->setCliente(true);
                $pessoa->setAdministrador(false);

                $entityManager->persist($pessoa);
                $entityManager->flush();
                
                return $this->redirectToRoute('pessoa_index');

            }

        
        }catch (Doctrine\DBAL\DBALException $e){

            throw new CustomUserMessageAuthenticationException($e->getMessage());
            // $request->getSession()->getFlashBag()->set('error', );
            
        } 

        return $this->render('pessoa/new.html.twig', [
            'pessoa' => $pessoa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pessoa_show", methods={"GET"})
     */
    public function show(Pessoa $pessoa): Response
    {
        return $this->render('pessoa/show.html.twig', [
            'pessoa' => $pessoa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pessoa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pessoa $pessoa): Response
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PessoaType::class, $pessoa);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            try{

                // $this->getDoctrine()->getManager()->flush();
                $em->merge($pessoa);
	    		$em->flush();

                return $this->redirectToRoute('pessoa_index');

            }catch (\Exception $e){
    
                throw new Exception($e->getMessage());
                // $request->getSession()->getFlashBag()->set('error', );
                
            } 
        }

        return $this->render('pessoa/edit.html.twig', [
            'pessoa' => $pessoa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pessoa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pessoa $pessoa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pessoa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pessoa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pessoa_index');
    }

    /** 
     * @Route("/listacidades", name="pessoa_lista_cidades", methods={"POST"})
     */
	public function listaCidades(Request $request)
	{

		$em = $this->getDoctrine()->getManager();
		
		$estadoId  = $request->request->get('estadoId');
        $estado = $em->getRepository(Estado::class)->findOneById($estadoId);

		if (!$estado) {
			throw $this->createNotFoundException('Estado não encontrado na requisição.');
		}
        
        $cidades = $em->getRepository(Cidade::class)->findByFkEstadoId($estado->getId());
        
		$retorno = [];
        foreach($cidades as $c){

            $retorno[] = [
                'id' => $c->getId(),
                'nome' => $c->getNome()
            ];
            
        }
		
		return new JsonResponse($retorno, JsonResponse::HTTP_OK);

	}
}
