<?php

namespace App\Controller;

use App\Entity\Bairro;
use App\Entity\Cidade;
use App\Form\BairroType;
use App\Repository\BairroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/bairro")
 */
class BairroController extends AbstractController
{
    /**
     * @Route("/", name="bairro_index", methods={"GET"})
     */
    public function index(BairroRepository $bairroRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $page = $request->query->getInt('page',1);

        $bairros = $bairroRepository->findAll();

        $bairros = $paginator->paginate($bairros, $page, 15);

        return $this->render('bairro/index.html.twig', [
            'bairros' => $bairros,
        ]);
    }

    /**
     * @Route("/new", name="bairro_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bairro = new Bairro();
        $form = $this->createForm(BairroType::class, $bairro);

        try{

            if ($request->isMethod('POST')) {

                $form->handleRequest($request);
                $entityManager = $this->getDoctrine()->getManager();

                $cidadeId = $request->request->get('bairro')['fkCidadeId'];
                $bairro->setFkCidadeId( $entityManager->getRepository(Cidade::class)->findOneById($cidadeId) );
                
                $entityManager->persist($bairro);
                $entityManager->flush();

                return $this->redirectToRoute('bairro_index');

            }
        }catch (\Exception $e){
            throw new Exception($e->getMessage());
        }

        return $this->render('bairro/new.html.twig', [
            'bairro' => $bairro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bairro_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bairro $bairro): Response
    {
        $form = $this->createForm(BairroType::class, $bairro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bairro_index');
        }

        return $this->render('bairro/edit.html.twig', [
            'bairro' => $bairro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bairro_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bairro $bairro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bairro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bairro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bairro_index');
    }
}
