<?php

namespace App\Repository;

use App\Entity\TipoImovel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoImovel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoImovel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoImovel[]    findAll()
 * @method TipoImovel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoImovelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoImovel::class);
    }

    // /**
    //  * @return TipoImovel[] Returns an array of TipoImovel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoImovel
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
