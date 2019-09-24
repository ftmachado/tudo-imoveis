<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Estado;

class EstadoFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	
        $estados = [
            [
                'id' => '1',
                'sigla' => 'AC',
                'nome' => 'Acre'
            ],
            [
                'id' => '2',
                'sigla' => 'AL',
                'nome' => 'Alagoas'
            ],
            [
                'id' => '3',
                'sigla' => 'AP',
                'nome' => 'Amapá'
            ],
            [
                'id' => '4',
                'sigla' => 'AM',
                'nome' => 'Amazonas'
            ],
            [
                'id' => '5',
                'sigla' => 'BA',
                'nome' => 'Bahia'
            ],
            [
                'id' => '6',
                'sigla' => 'CE',
                'nome' => 'Ceará'
            ],
            [
                'id' => '7',
                'sigla' => 'DF',
                'nome' => 'Distrito Federal'
            ],
            [
                'id' => '8',
                'sigla' => 'ES',
                'nome' => 'Espírito Santo'
            ],
            [
                'id' => '9',
                'sigla' => 'GO',
                'nome' => 'Goiás'
            ],
            [
                'id' => '10',
                'sigla' => 'MA',
                'nome' => 'Maranhão'
            ],
            [
                'id' => '11',
                'sigla' => 'MT',
                'nome' => 'Mato Grosso'
            ],
            [
                'id' => '12',
                'sigla' => 'MS',
                'nome' => 'Mato Grosso do Sul'
            ],
            [
                'id' => '13',
                'sigla' => 'MG',
                'nome' => 'Minas Gerais'
            ],
            [
                'id' => '14',
                'sigla' => 'PA',
                'nome' => 'Pará'
            ],
            [
                'id' => '15',
                'sigla' => 'PB',
                'nome' => 'Paraíba'
            ],
            [
                'id' => '16',
                'sigla' => 'PR',
                'nome' => 'Paraná'
            ],
            [
                'id' => '17',
                'sigla' => 'PE',
                'nome' => 'Pernambuco'
            ],
            [
                'id' => '18',
                'sigla' => 'PI',
                'nome' => 'Piauí'
            ],
            [
                'id' => '19',
                'sigla' => 'RJ',
                'nome' => 'Rio de Janeiro'
            ],
            [
                'id' => '20',
                'sigla' => 'RN',
                'nome' => 'Rio Grande do Norte'
            ],
            [
                'id' => '21',
                'sigla' => 'RS',
                'nome' => 'Rio Grande do Sul'
            ],
            [
                'id' => '22',
                'sigla' => 'RO',
                'nome' => 'Rondônia'
            ],
            [
                'id' => '23',
                'sigla' => 'RR',
                'nome' => 'Roraima'
            ],
            [
                'id' => '24',
                'sigla' => 'SC',
                'nome' => 'Santa Catarina'
            ],
            [
                'id' => '25',
                'sigla' => 'SP',
                'nome' => 'São Paulo'
            ],
            [
                'id' => '26',
                'sigla' => 'SE',
                'nome' => 'Sergipe'
            ],
            [
                'id' => '27',
                'sigla' => 'TO',
                'nome' => 'Tocantins'
            ]
        ];

        foreach ($estados as $item) {

            $estado = $manager->getRepository(Estado::class)->findOneByNome($item['nome']);

            if (!$estado) {

                $estado = new Estado();

                $estado->setId($item['id']);
                $estado->setNome($item['nome']);
                $estado->setSigla($item['sigla']);

                // $metadata = $manager->getClassMetaData(get_class($estado));
                // $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                // $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
                
                $manager->persist($estado);
                $manager->flush();
                
            } else {

                $estado->setnome($item['nome']);
                $estado->setsigla($item['sigla']);

                $manager->merge($estado);
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
        return 2;
    }
}
