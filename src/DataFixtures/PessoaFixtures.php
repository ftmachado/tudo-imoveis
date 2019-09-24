<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Pessoa;

class PessoaFixtures extends Fixture implements OrderedFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $pessoas = [
            [
                'id' => 1,
                'cpf' => '01448971055',
                'rg' => '1089489866',
                'nome' => 'Fhabiana Thieli Machado',
                'telefonePrincipal' => '55999074249',
                'usuario' => 'fhabiana',
                'email' => 'thielisantos@hotmail.com',
                'password' => 'teste123@',
                'cliente' => true,
                'administrador' => true,
            ]
        ];

        foreach ($pessoas as $item) {
            
            $pessoa = $manager->getRepository(Pessoa::class)->findOneByEmail($item['email']);

            if (!$pessoa) {
                
                $pessoa = new Pessoa();

                $pessoa->setId($item['id']);
                $pessoa->setCpf($item['cpf']);
                $pessoa->setRg($item['rg']);
                $pessoa->setNome($item['nome']);
                $pessoa->setTelefonePrincipal($item['telefonePrincipal']);
                $pessoa->setUsuario($item['usuario']);
                $pessoa->setEmail($item['email']);
                $pessoa->setPassword($this->passwordEncoder->encodePassword($pessoa,$item['password']));
                $pessoa->setCliente($item['cliente']);
                $pessoa->setAdministrador($item['administrador']);
                
                $manager->persist($pessoa);
                $manager->flush();
            
            } else {

                $pessoa->setCpf($item['cpf']);
                $pessoa->setRg($item['rg']);
                $pessoa->setNome($item['nome']);
                $pessoa->setTelefonePrincipal($item['telefonePrincipal']);
                $pessoa->setUsuario($item['usuario']);
                $pessoa->setEmail($item['email']);
                $pessoa->setPassword($this->passwordEncoder->encodePassword($pessoa,$item['password']));
                $pessoa->setCliente($item['cliente']);
                $pessoa->setAdministrador($item['administrador']);

                $manager->merge($pessoa);
                $manager->flush();

            }

        }

    }

    /**
     * Get the order of this fixture
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
