<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Repository\PessoaRepository;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
                $pessoa->setPassword($passwordEncoder->encodePassword($pessoa, $senhaPlana));
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
}
