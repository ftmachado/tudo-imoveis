<?php

namespace App\Controller;

use App\Entity\Imovel;
use App\Form\InicioImovelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    /**
     * @Route("/inicio", name="inicio")
     */
    public function index()
    {
        $imovel = new Imovel();
        $form = $this->createForm(InicioImovelType::class, $imovel);

        $em = $this->getDoctrine()->getManager();

        return $this->render('inicio/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
