<?php

namespace App\Controller;

use App\Entity\Imovel;
use App\Entity\Imobiliaria;
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
        $imobiliaria = $em->getRepository(Imobiliaria::class)->findOneById(1);

        if (!$imovel) {
            throw $this->createNotFoundException('Imovel não encontrado');
        }

        $imovel->{"files"} = self::getPhotos($imovel->getId());

        $total = $imovel->getValorImobiliaria() + $imovel->getValorIptu() + $imovel->getValorCondominio();

        return $this->render('detalhe_imovel/index.html.twig', [
            'imovel' => $imovel,
            'imobiliaria' => $imobiliaria,
            'total' => $total
        ]);
    }

    /**
     * Função para buscar todos os arquivos de cada diretório
     */
    public function getPhotos($id) {
        
        $basepath = "./uploads/".$id."/";

        if (!is_dir($basepath)) {
            return null;
        } else {
            
            $files = scandir($basepath);

            $result = [];
            if (!isset($files) || count($files) == 2) {
                return null;
            } else {
                foreach ($files as $file) {
                    if ( '.'!=$file && '..'!=$file) { 
                        $result[] = "http://".$_SERVER['HTTP_HOST']."/uploads/".$id."/".$file;
                    }
                }
            }

            return $result;

        }

    }
}
