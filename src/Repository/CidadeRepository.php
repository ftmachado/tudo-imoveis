<?php

namespace App\Repository;

use App\Entity\Cidade;
use App\Entity\ImobiliariaAtuacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cidade|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cidade|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cidade[]    findAll()
 * @method Cidade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CidadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cidade::class);
    }

    /**
     * @return Cidade[] Returns an array of Cidade objects
     */
    public function findCidadeAtuacao($estado)
    {
        return $this->createQueryBuilder('c')
            ->innerJoin(ImobiliariaAtuacao::class, 'i', 'WITH', 'c.id = i.fkCidadeId')
            ->andWhere('i.fkEstadoId = :estado')
            ->setParameter(':estado', $estado)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Cidade
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
