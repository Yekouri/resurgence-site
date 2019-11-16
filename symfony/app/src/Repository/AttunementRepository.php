<?php

namespace App\Repository;

use App\Entity\Attunement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Attunement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attunement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attunement[]    findAll()
 * @method Attunement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttunementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attunement::class);
    }

    // /**
    //  * @return Attunement[] Returns an array of Attunement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Attunement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
