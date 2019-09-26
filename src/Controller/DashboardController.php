<?php

namespace App\Controller;

use App\Entity\Imobiliaria;
use App\Entity\Imovel;
use App\Entity\Pessoa;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $imob = $em->getRepository(Imobiliaria::class)->findOneById(1);

        $total = [];
        $vender = $em->getRepository(Imovel::class)->findBy(['tipoAnuncio' => 'vender', 'status' => 'disponivel']);
        $alugar = $em->getRepository(Imovel::class)->findBy(['tipoAnuncio' => 'alugar', 'status' => 'disponivel']);
        $cliente = $em->getRepository(Pessoa::class)->findBy(['cliente' => true]);

        $total['vender'] = count($vender);
        $total['alugar'] = count($alugar);
        $total['cliente'] = count($cliente);


        return $this->render('dashboard/index.html.twig', [
            'nomeImobiliaria' => $imob->getNomeFantasia(),
            'total' => $total
        ]);
    }
}
