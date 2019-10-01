<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DropzoneController extends AbstractController
{
    /**
     * @Route("/admin/file-input", name="file_input")
     */
    public function input(Request $request)
    {
       
        $basepath = "./uploads/temp/";
        $erro = "";

        if (!empty($_FILES)) {

            if (!is_dir($basepath)) {
                mkdir($basepath, 0777);
            }

            foreach ($_FILES['file']['name'] as $key => $value) {
                
                $uploadfile = $basepath.basename($value);  //['name'][0]

                if (!move_uploaded_file($_FILES['file']['tmp_name'][$key], $uploadfile)) {
                    $erro .= $value;
                }
                
            }

            if ($erro != "") {
                return new JsonResponse("Não foi possivel mover o(s) arquivo(s) ".$erro, JsonResponse::HTTP_BAD_REQUEST);    
            }

            return new JsonResponse("Upload realizado com sucesso!", JsonResponse::HTTP_OK);
        
        }
        
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

        if (!empty($_FILES)) {

            if (!is_dir($basepath)) {
                mkdir($basepath, 0777);
            }
            
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

    /**
     * Move um arquivo por vez
     * @Route("/admin/file-delete", name="file_delete")
     */
    public function delete(Request $request)
    {
        $id = $request->request->get('id');
        $fileName = $request->request->get('fileName');

        if (is_null($fileName || is_null($id))) {
            return new JsonResponse("Id ou Nome de arquivo não informado", JsonResponse::HTTP_BAD_REQUEST);
        }

        $basepath = "./uploads/".$id."/";

        unlink($basepath.$fileName);

    }

}
