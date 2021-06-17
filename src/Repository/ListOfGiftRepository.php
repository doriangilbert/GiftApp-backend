<?php

namespace App\Repository;

use App\Entity\ListOfGift;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListOfGift|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListOfGift|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListOfGift[]    findAll()
 * @method ListOfGift[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListOfGiftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListOfGift::class);
    }

    // /**
    //  * @return ListOfGift[] Returns an array of ListOfGift objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListOfGift
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
