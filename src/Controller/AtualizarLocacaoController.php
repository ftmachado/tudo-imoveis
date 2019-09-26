<?php

namespace App\Controller;

use App\Entity\Imovel;
use App\Repository\ImovelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;


class AtualizarLocacaoController extends AbstractController
{
    /**
     * @Route("/admin/atualizar-locacao", name="atualizar_locacao")
     */
    public function index(ImovelRepository $imovelRepository, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {

            $ids = $request->request->get('atualizar_locacao')['checkLocacao'];
            $status = $request->request->get('atualizar_locacao')['status'];

            try{

                foreach ($ids as $id) {
                    
                    $imovel = $em->getRepository(Imovel::class)->findOneById($id);

                    if (!$imovel) {
                        throw new Exception("Não foi possível encontrar o imóvel "+$id);
                    }

                    $imovel->setStatus($status);
                    $imovel->setStatusData(new \DateTime());
                    $em->merge($imovel);
                    $em->flush();

                }

                return $this->redirectToRoute('imovel_index');

            }catch (\Exception $e){
                throw new Exception($e->getMessage());
            }

        }

        return $this->render('atualizar_locacao/index.html.twig', [
            'imovels' => $imovelRepository->findBy(['status' => 'disponivel', 'tipoAnuncio' => 'alugar']),
        ]);
    }
    
}
