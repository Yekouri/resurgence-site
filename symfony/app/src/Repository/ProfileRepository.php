<?php

namespace App\Repository;

use App\Entity\Profile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Profile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profile[]    findAll()
 * @method Profile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profile::class);
    }

    public function findProfilesByUser($userId) {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p')
            ->join('p.user', 'c')
            ->where('c.id = :userId')
            ->setParameter('userId', $userId);
        return $qb->getQuery()->getResult();
    }

    public function findProfile($profileId, $userId) {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p')
            ->join('p.user', 'c')
            ->where('p.id = :profileId')
            ->andWhere('c.id = :userId')
            ->setParameter('userId', $userId)
            ->setParameter('profileId', $profileId);
        $result = $qb->getQuery()->getResult();
        return !empty($result) ? $result[0] : [];
    }

    // /**
    //  * @return Profile[] Returns an array of Profile objects
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
    public function findOneBySomeField($value): ?Profile
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
