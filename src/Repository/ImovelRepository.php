<?php

namespace App\Repository;

use App\Entity\Imovel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method Imovel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imovel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imovel[]    findAll()
 * @method Imovel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImovelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imovel::class);
    }

    /**
     * @return Imovel[] Returns an array of Imovel objects
     * Função para pesquisar com os critérios e range de preço
     */
    public function findWithPrice($criterios, $min = null, $max = null)
    {
        $where = " ";
        foreach ($criterios as $chave => $valor) {
            $join = " AND ";
            $where .= "i.".$chave." = '".$valor."'".$join;
        }
        
        if ($min !== null) {
            $where .= "i.valorImobiliaria >= '".$min."'".$join;
        }
        if ($max !== null) {
            $where .= "i.valorImobiliaria <= '".$max."'".$join;
        }
        
        $where = rtrim($where, " AND ");
        
        return $this->createQueryBuilder('i')
            ->andWhere($where)
            ->getQuery()
            ->getResult()
        ;
        
    }

    /*
    public function findOneBySomeField($value): ?Imovel
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
