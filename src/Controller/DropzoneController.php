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
}
