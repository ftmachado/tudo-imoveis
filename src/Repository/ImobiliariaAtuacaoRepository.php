<?php

namespace App\Repository;

use App\Entity\ImobiliariaAtuacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImobiliariaAtuacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImobiliariaAtuacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImobiliariaAtuacao[]    findAll()
 * @method ImobiliariaAtuacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImobiliariaAtuacaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImobiliariaAtuacao::class);
    }

    // /**
    //  * @return ImobiliariaAtuacao[] Returns an array of ImobiliariaAtuacao objects
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
    public function findOneBySomeField($value): ?ImobiliariaAtuacao
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
