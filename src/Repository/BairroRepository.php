<?php

namespace App\Repository;

use App\Entity\Bairro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bairro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bairro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bairro[]    findAll()
 * @method Bairro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BairroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bairro::class);
    }

    // /**
    //  * @return Bairro[] Returns an array of Bairro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bairro
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
