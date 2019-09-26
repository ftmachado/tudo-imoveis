<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DropzoneController extends AbstractController
{
    /**
     * @Route("/admin/file-input", name="file_input")
     */
    public function input()
    {
       
        $uploadfile = "./uploads/" . basename($_FILES['file']['name']); 
               
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
              echo "O arquivo é valido e foi carregado com sucesso.\n";
       } else {
             echo "Algo está errado aqui!\n";
       }
              
       echo "Aqui estão algumas informações de depuração para você:";
       print_r($_FILES);
              
       return new JsonResponse([], JsonResponse::HTTP_OK);
    }

    /**
     * Move um arquivo por vez
     * @Route("/admin/{id}/file-edit", name="file_edit")
     */
    public function edit($id)
    {
        if (is_null($id) || $id == 0 ) {
            return new JsonResponse("Id não informado", JsonResponse::HTTP_FAILED_DEPENDENCY);
        }

        $basepath = "./uploads/".$id."/";

        if (!is_dir($basepath)) {
            mkdir($basepath, 0777);
        }

        if (!empty($_FILES)) {

            $uploadfile = $basepath.basename($_FILES['file']['name']); 
                   
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                return new JsonResponse("Não foi possivel mover o arquivo", JsonResponse::HTTP_BAD_REQUEST);    
            }       

            return new JsonResponse([], JsonResponse::HTTP_OK);
        
        } else {

            $files = scandir($basepath);

            $result = [];

            foreach ($files as $file) {
                if ( '.'!=$file && '..'!=$file) { 
                    $result[] = [
                        'name' => $file,
                        'size' => filesize($basepath.$file),
                        'file' => "http://".$_SERVER['HTTP_HOST']."/uploads/".$id."/".$file
                    ];
                }
            }

            return new JsonResponse($result, JsonResponse::HTTP_OK);
    
        }
                
    }

}
