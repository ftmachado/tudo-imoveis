<?php

namespace App\Controller;

use App\Entity\Imovel;
use App\Entity\Imobiliaria;
use App\Form\InicioImovelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class InicioController extends AbstractController
{
    /**
     * @Route("/inicio", name="inicio")
     */
    public function index(Request $request)
    {
        $imovel = new Imovel();
        $form = $this->createForm(InicioImovelType::class, $imovel);

        $em = $this->getDoctrine()->getManager();

        $destaques = $em->getRepository(Imovel::class)->findBy([],['id' => 'DESC'], 3);
        $imobiliaria = $em->getRepository(Imobiliaria::class)->findOneById(1);
        
        foreach ($destaques as $i) {
            $i->{"path"} = self::getThumbnail($i->getid());
        }

        return $this->render('inicio/index.html.twig', [
            'form' => $form->createView(),
            'destaques' => $destaques,
            'imobiliaria' => $imobiliaria
        ]);
    }

    /**
     * Função para buscar o primeiro arquivo de cada diretório
     */
    public function getThumbnail($id) {
        
        $basepath = "./uploads/".$id."/";

        if (!is_dir($basepath)) {
            return "/images/sem_foto.png";
        } else {
            
            $files = scandir($basepath);

            if (isset($files[2]) && $files[2] != "") {
                return "/uploads/".$id."/".$files[2];
            } else {
                return "/images/sem_foto.png";
            }

        }

    }

}
