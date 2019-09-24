<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DropzoneController extends AbstractController
{
    /**
     * @Route("/file-input", name="file_input")
     */
    public function input()
    {
        
        $uploaddir = './uploads';
        $uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']); 
               
        echo "<pre>";
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
              echo "O arquivo é valido e foi carregado com sucesso.\n";
       } else {
             echo "Algo está errado aqui!\n";
       }
              
       echo "Aqui estão algumas informações de depuração para você:";
       print_r($_FILES);
              
       print "</pre>";
    
       return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
