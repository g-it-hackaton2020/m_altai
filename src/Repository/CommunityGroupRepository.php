<?php

namespace App\Repository;

use App\Entity\CommunityGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommunityGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommunityGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommunityGroup[]    findAll()
 * @method CommunityGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommunityGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommunityGroup::class);
    }

    // /**
    //  * @return CommunityGroup[] Returns an array of CommunityGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommunityGroup
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
