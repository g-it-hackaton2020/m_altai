<?php

namespace App\Repository;

use App\Entity\MessageGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MessageGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageGroup[]    findAll()
 * @method MessageGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MessageGroup::class);
    }

    // /**
    //  * @return MessageGroup[] Returns an array of MessageGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MessageGroup
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
