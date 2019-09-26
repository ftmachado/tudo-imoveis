<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DestaqueController extends AbstractController
{
    /**
     * @Route("/admin/destaque", name="destaque_index")
     */
    public function index()
    {
        return $this->render('destaque/index.html.twig', [
        ]);
    }
}
