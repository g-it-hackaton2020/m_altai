<?php

namespace App\Repository;

use App\Entity\DocStad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocStad|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocStad|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocStad[]    findAll()
 * @method DocStad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocStadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocStad::class);
    }

    // /**
    //  * @return DocStad[] Returns an array of DocStad objects
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
    public function findOneBySomeField($value): ?DocStad
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
