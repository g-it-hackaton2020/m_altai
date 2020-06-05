<?php

namespace App\Repository;

use App\Entity\PetitionType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PetitionType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PetitionType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PetitionType[]    findAll()
 * @method PetitionType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetitionTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetitionType::class);
    }

    // /**
    //  * @return PetitionType[] Returns an array of PetitionType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PetitionType
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
