<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Imovel;
use App\Form\BuscaImovelType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;

class BuscaImovelController extends AbstractController
{
    /**
     * @Route("/imoveis/busca", name="busca_imovel")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $imovel = new Imovel();
        $form = $this->createForm(BuscaImovelType::class, $imovel);
        
        $em = $this->getDoctrine()->getManager();

        try{

            if ($request->isMethod('POST')) {

                $data = $request->request->all();
                
                $criterios = [];
                foreach ($data['busca_imovel'] as $chave => $item) {
                    if ($item != "" && !is_array($item)) {
                        $criterios[$chave] = $item;
                    }
                }

                $imoveisFiltrados = $em->getRepository(Imovel::class)->findBy($criterios);
                
            } else {
                
                $imoveisFiltrados = $em->getRepository(Imovel::class)->findAll();
                
            }

            $page = $request->query->getInt('page',1);
            $imoveisFiltrados = $paginator->paginate($imoveisFiltrados, $page, 5);

            foreach ($imoveisFiltrados as $i) {
                $i->{"path"} = self::getThumbnail($i->getid());
            }

        }catch (\Exception $e){
            throw new Exception($e->getMessage());
        } 

        return $this->render('busca_imovel/index.html.twig', [
            'form' => $form->createView(),
            'imoveis' => (isset($imoveisFiltrados) ? $imoveisFiltrados : NULL)
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
