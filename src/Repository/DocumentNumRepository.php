<?php

namespace App\Repository;

use App\Entity\DocumentNum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentNum|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentNum|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentNum[]    findAll()
 * @method DocumentNum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentNumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentNum::class);
    }

    // /**
    //  * @return DocumentNum[] Returns an array of DocumentNum objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocumentNum
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
