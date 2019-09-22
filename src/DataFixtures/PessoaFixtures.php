<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Pessoa;

class PessoaFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $pessoa = new Pessoa();

        $pessoa->setCpf('01448971055');
        $pessoa->setRg('1089489866');
        $pessoa->setNome('Fhabiana Thieli Machado');
        $pessoa->setTelefonePrincipal('55999074249');
        $pessoa->setUsuario('fhabiana');
        $pessoa->setEmail('thielisantos@hotmail.com');
        $pessoa->setPassword($this->passwordEncoder->encodePassword($pessoa,'teste123@'));
        $pessoa->setCliente(true);
        $pessoa->setAdministrador(true);
        
        $manager->persist($pessoa);
        $manager->flush();
    }
}
