<?php

namespace App\Repository;

use App\Entity\Imobiliaria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Imobiliaria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imobiliaria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imobiliaria[]    findAll()
 * @method Imobiliaria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImobiliariaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imobiliaria::class);
    }

    // /**
    //  * @return Imobiliaria[] Returns an array of Imobiliaria objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imobiliaria
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
