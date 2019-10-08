<?php

namespace App\DataFixtures;

use App\Entity\Pessoa;
use App\Entity\TipoImovel;
use App\Entity\Imovel;
use App\Entity\Estado;
use App\Entity\Cidade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ImovelTestFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $imoveis = [
            [
                'titulo' => 'Casa da Colina',
                'fkTipoImovel' => 1,
                'tipoAnuncio' => 'alugar',
                'fkEstadoId' => 21,
                'fkCidadeId' => 4389,
                'endereco' => 'Rua da Colina',
                'numero' => 151,
                'CEP' => '97050390',
                'complemento' => 'Morro',
                'areaTotal' => 100,
                'areaUtil' => 80,
                'garagem' => 1,
                'quarto' => 3,
                'banheiro' => 1,
                'exposicaoSolar' => 'norte',
                'posicaoPredio' => 0,
                'status' => 'disponivel',
                'fkProprietarioId' => 1,
                'valorProprietario' => 1500.00,
                'valorCondominio' => 150.00,
                'valorIptu' => 45.00,
                'valorImobiliaria' => 99.00,
            ],
            [
                'titulo' => 'Casa da Sanga',
                'fkTipoImovel' => 1,
                'tipoAnuncio' => 'vender',
                'fkEstadoId' => 21,
                'fkCidadeId' => 4389,
                'endereco' => 'Estrada sem fim',
                'numero' => NULL,
                'CEP' => '97800050',
                'complemento' => 'Depois da porteira',
                'areaTotal' => 100,
                'areaUtil' => 80,
                'garagem' => 1,
                'quarto' => 3,
                'banheiro' => 1,
                'exposicaoSolar' => 'sul',
                'posicaoPredio' => 0,
                'status' => 'disponivel',
                'fkProprietarioId' => 1,
                'valorProprietario' => 150000.00,
                'valorCondominio' => 0.00,
                'valorIptu' => 155.00,
                'valorImobiliaria' => 99.70,
            ],
            [
                'titulo' => 'Casa da Árvore',
                'fkTipoImovel' => 1,
                'tipoAnuncio' => 'alugar',
                'fkEstadoId' => 21,
                'fkCidadeId' => 4389,
                'endereco' => 'Avenida Roraima',
                'numero' => NULL,
                'CEP' => '98400000',
                'complemento' => 'BR 386',
                'areaTotal' => 100,
                'areaUtil' => 80,
                'garagem' => 1,
                'quarto' => 3,
                'banheiro' => 1,
                'exposicaoSolar' => 'leste',
                'posicaoPredio' => 0,
                'status' => 'disponivel',
                'fkProprietarioId' => 1,
                'valorProprietario' => 1500.00,
                'valorCondominio' => 150.00,
                'valorIptu' => 45.00,
                'valorImobiliaria' => 99.00,
            ],
            [
                'titulo' => 'Casa do Sol',
                'fkTipoImovel' => 1,
                'tipoAnuncio' => 'alugar',
                'fkEstadoId' => 21,
                'fkCidadeId' => 4389,
                'endereco' => 'Avenida Independência',
                'numero' => 3751,
                'CEP' => '98300000',
                'complemento' => 'Vista Alegre',
                'areaTotal' => 100,
                'areaUtil' => 80,
                'garagem' => 1,
                'quarto' => 3,
                'banheiro' => 1,
                'exposicaoSolar' => 'norte',
                'posicaoPredio' => 0,
                'status' => 'disponivel',
                'fkProprietarioId' => 1,
                'valorProprietario' => 20000.00,
                'valorCondominio' => 200.08,
                'valorIptu' => 55.00,
                'valorImobiliaria' => 300.03,
            ],
            [
                'titulo' => 'Casa do Pastel',
                'fkTipoImovel' => 1,
                'tipoAnuncio' => 'alugar',
                'fkEstadoId' => 21,
                'fkCidadeId' => 4389,
                'endereco' => 'Avenida Ângelo Bolson',
                'numero' => 338,
                'CEP' => '97070000',
                'complemento' => 'Ao lado da paróquia',
                'areaTotal' => 100,
                'areaUtil' => 80,
                'garagem' => 1,
                'quarto' => 3,
                'banheiro' => 1,
                'exposicaoSolar' => 'oeste',
                'posicaoPredio' => 0,
                'status' => 'disponivel',
                'fkProprietarioId' => 1,
                'valorProprietario' => 5500.99,
                'valorCondominio' => 350.00,
                'valorIptu' => 160.00,
                'valorImobiliaria' => 1199.00,
            ]            
        ];

        foreach ($imoveis as $item) {
            
            $imovel = $manager->getRepository(Imovel::class)->findOneByTitulo($item['titulo']);

            if (!$imovel) {
                
                $imovel = new Imovel();

                $imovel->setTitulo($item['titulo']);
                $imovel->setFkTipoImovelId( 
                    $manager->getRepository(TipoImovel::class)->findOneById($item['fkTipoImovel']) 
                );
                $imovel->setTipoAnuncio($item['tipoAnuncio']);
                $imovel->setFkEstadoId(
                    $manager->getRepository(Estado::class)->findOneById($item['fkEstadoId'])
                );
                $imovel->setFkCidadeId(
                    $manager->getRepository(Cidade::class)->findOneById($item['fkCidadeId'])
                );
                $imovel->setEndereco($item['endereco']);
                $imovel->setNumero($item['numero']);
                $imovel->setCep($item['CEP']);
                $imovel->setComplemento($item['complemento']);
                $imovel->setAreaTotal($item['areaTotal']);
                $imovel->setAreaUtil($item['areaUtil']);
                $imovel->setGaragem($item['garagem']);
                $imovel->setQuarto($item['quarto']);
                $imovel->setBanheiro($item['banheiro']);
                $imovel->setExposicaoSolar($item['exposicaoSolar']);
                $imovel->setPosicaoPredio($item['posicaoPredio']);
                $imovel->setStatus($item['status']);
                $imovel->setStatusData(new \Datetime());
                $imovel->setFkProprietarioId(
                    $manager->getRepository(Pessoa::class)->findOneById($item['fkProprietarioId'])
                );
                $imovel->setValorProprietario($item['valorProprietario']);
                $imovel->setValorCondominio($item['valorCondominio']);
                $imovel->setValorIptu($item['valorIptu']);
                $imovel->setValorImobiliaria($item['valorImobiliaria']);
                
                $manager->persist($imovel);
                $manager->flush();
            
            } else {

                $imovel->setTitulo($item['titulo']);
                $imovel->setFkTipoImovelId( 
                    $manager->getRepository(TipoImovel::class)->findOneById($item['fkTipoImovel']) 
                );
                $imovel->setTipoAnuncio($item['tipoAnuncio']);
                $imovel->setFkEstadoId(
                    $manager->getRepository(Estado::class)->findOneById($item['fkEstadoId'])
                );
                $imovel->setFkCidadeId(
                    $manager->getRepository(Cidade::class)->findOneById($item['fkCidadeId'])
                );
                $imovel->setEndereco($item['endereco']);
                $imovel->setNumero($item['numero']);
                $imovel->setCep($item['CEP']);
                $imovel->setComplemento($item['complemento']);
                $imovel->setAreaTotal($item['areaTotal']);
                $imovel->setAreaUtil($item['areaUtil']);
                $imovel->setGaragem($item['garagem']);
                $imovel->setQuarto($item['quarto']);
                $imovel->setBanheiro($item['banheiro']);
                $imovel->setExposicaoSolar($item['exposicaoSolar']);
                $imovel->setPosicaoPredio($item['posicaoPredio']);
                $imovel->setStatus($item['status']);
                $imovel->setStatusData(new \Datetime());
                $imovel->setFkProprietarioId(
                    $manager->getRepository(Pessoa::class)->findOneById($item['fkProprietarioId'])
                );
                $imovel->setValorProprietario($item['valorProprietario']);
                $imovel->setValorCondominio($item['valorCondominio']);
                $imovel->setValorIptu($item['valorIptu']);
                $imovel->setValorImobiliaria($item['valorImobiliaria']);
                $manager->merge($imovel);
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
        return 4;
    }

}
