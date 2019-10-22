<?php

namespace App\Controller;

use App\Entity\Imovel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DetalheImovelController extends AbstractController
{
    /**
     * @Route("/busca/imovel/detalhe/{id}", name="detalhe_imovel")
     */
    public function index(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $imovel = $em->getRepository(Imovel::class)->findOneById($id);

        if (!$imovel) {
            throw $this->createNotFoundException('Imovel não encontrado');
        }

        return $this->render('detalhe_imovel/index.html.twig', [
            'imovel' => $imovel
        ]);
    }
}
