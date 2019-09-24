<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Imobiliaria;

class ImobiliariaFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	
        $imobiliarias = [
            [
                'id' => '1',
                'cnpj' => '30090427000199',
                'nomeFantasia' => 'Tudo Imóveis',
                'telefone' => '5532200300'
            ]
        ];

        foreach ($imobiliarias as $item) {

            $imobiliaria = $manager->getRepository(Imobiliaria::class)->findOneByCnpj($item['cnpj']);

            if (!$imobiliaria) {

                $imobiliaria = new Imobiliaria();

                $imobiliaria->setId($item['id']);
                $imobiliaria->setCnpj($item['cnpj']);
                $imobiliaria->setNomeFantasia($item['nomeFantasia']);
                $imobiliaria->setTelefone($item['telefone']);

                // $metadata = $manager->getClassMetaData(get_class($imobiliaria));
                // $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                // $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
                
                $manager->persist($imobiliaria);
                $manager->flush();
                
            } else {

                $imobiliaria->setCnpj($item['cnpj']);
                $imobiliaria->setNomeFantasia($item['nomeFantasia']);
                $imobiliaria->setTelefone($item['telefone']);

                $manager->merge($imobiliaria);
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
        return 3;
    }
}
