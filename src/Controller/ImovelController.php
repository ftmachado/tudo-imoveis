<?php

namespace App\Controller;

use App\Entity\Imovel;
use App\Form\ImovelType;
use App\Repository\ImovelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/imovel")
 */
class ImovelController extends AbstractController
{
    /**
     * @Route("/", name="imovel_index", methods={"GET"})
     */
    public function index(ImovelRepository $imovelRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $page = $request->query->getInt('page',1);

        $imoveis = $imovelRepository->findAll();

        $imoveis = $paginator->paginate($imoveis, $page, 15);

        return $this->render('imovel/index.html.twig', [
            'imovels' => $imoveis,
        ]);
    }

    /**
     * @Route("/new", name="imovel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $imovel = new Imovel();
        $form = $this->createForm(ImovelType::class, $imovel);
     
        try{

            if ($request->isMethod('POST')) {

                $form->handleRequest($request);
                
                $entityManager = $this->getDoctrine()->getManager();

                $imovel->setStatusData(new \DateTime());

                $entityManager->persist($imovel);
                $entityManager->flush();

                /*
                * Verifica se existe um diretório temp e renomeia para ID
                */
                $oldpath = "./uploads/temp/";
                $newpath = "./uploads/".$imovel->getId()."/";

                if (is_dir($oldpath)) {
                    rename($oldpath, $newpath);
                }

                return $this->redirectToRoute('imovel_index');

            }
        }catch (\Exception $e){
            throw new Exception($e->getMessage());
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
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ImovelType::class, $imovel);

        
        if ($request->isMethod('POST')) {
            
            $form->handleRequest($request);

            try{

                $imovel->setStatusData(new \DateTime());
                $em->merge($imovel);
	    		$em->flush();

                return $this->redirectToRoute('imovel_index');

            }catch (\Exception $e){
                throw new Exception($e->getMessage());
            }

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

        $removepath = "./uploads/".$imovel->getId()."/";
        
        if (!is_dir($removepath)) {
            // throw new InvalidArgumentException("$removepath não é um diretório");
        } else {
            array_map('unlink', glob($removepath."*.*"));
            rmdir($removepath);
        }

        if ($this->isCsrfTokenValid('delete'.$imovel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($imovel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('imovel_index');
    }

    /** 
     * @Route("/listacidades", name="imovel_lista_cidades_atuacao", methods={"POST"})
     */
	public function listaCidadesAtuacao(Request $request)
	{

		$em = $this->getDoctrine()->getManager();
		
		$estadoId  = $request->request->get('estadoId');
        $estado = $em->getRepository(Estado::class)->findOneById($estadoId);

		if (!$estado) {
			throw $this->createNotFoundException('Estado não encontrado na requisição.');
		}
        
        $cidades = $em->getRepository(Cidade::class)->findCidadeAtuacao($estado->getId());
        
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
