<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Repository\PessoaRepository;
use App\Form\UserType;
use App\Form\TrocarSenhaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index")
     */
    public function index(PessoaRepository $pessoaRepository)
    {
        return $this->render('user/index.html.twig', [
            'pessoas' => $pessoaRepository->findBy(['administrador' => true])
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $pessoa = new Pessoa();
        $form = $this->createForm(UserType::class, $pessoa);

        try{

            if ($request->isMethod('POST')) {

                $form->handleRequest($request);

                $senhaPlana = $request->request->get('user')['password']['first'];

                $entityManager = $this->getDoctrine()->getManager();
                
                $pessoa->setRoles(['ROLE_ADMIN']);
                $pessoa->setPassword($passwordEncoder->encodePassword($pessoa, "imob@2019"));
                $pessoa->setCliente(false);
                $pessoa->setAdministrador(true);

                $entityManager->persist($pessoa);
                $entityManager->flush();
                
                return $this->redirectToRoute('user_index');

            }

        
        }catch (\Exception $e){
            throw new Exception($e->getMessage());
        } 

        return $this->render('user/new.html.twig', [
            'pessoa' => $pessoa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(Pessoa $pessoa): Response
    {
        return $this->render('user/show.html.twig', [
            'pessoa' => $pessoa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pessoa $pessoa): Response
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserType::class, $pessoa);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            try{
                
                $em->merge($pessoa);
	    		$em->flush();

                return $this->redirectToRoute('user_index');

            }catch (\Exception $e){
                throw new Exception($e->getMessage());
            }
            
        }

        return $this->render('user/edit.html.twig', [
            'pessoa' => $pessoa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pessoa $pessoa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pessoa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pessoa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/{id}/trocar-senha", name="user_trocar_senha", methods={"GET","POST"})
     */
    public function trocarSenha(Request $request, Pessoa $pessoa, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        
        $originalPassword = $pessoa->getPassword();
        
        $form = $this->createForm(TrocarSenhaType::class, $pessoa);

        if ($request->isMethod('POST')) {
            
    		try {
                $data = $request->request->get('trocar_senha');
				
    			if (array_key_exists('password', $data) && !empty($data['password']['first'])) {

					// if ($originalPassword !== $passwordEncoder->encodePassword($pessoa, $data['password_atual'])) {
					// 	throw new Exception("Senha informada não confere com a atual");
					// }
                    
                    if (strcmp($data['password']['first'], $data['password']['second']) == 0) {
                        $pessoa->setPassword($passwordEncoder->encodePassword($pessoa, $data['password']['first']));
                    } else {
                        throw new Exception("Senhas não conferem");
                    }
                    
        			
    			} else {
    			    $pessoa->setPassword($originalPassword);
				}
                
				$em->merge($pessoa);
                $em->flush();

                return $this->redirectToRoute('dashboard');

            } catch (\Exception $e) {
                throw new Exception($e->getMessage());
            }

        }

        return $this->render('user/trocar_senha.html.twig', [
            'pessoa' => $pessoa,
            'form' => $form->createView(),
        ]);

    }

}
