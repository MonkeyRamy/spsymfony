<?php

namespace App\Repository;

use App\Entity\PaymentCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaymentCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentCategory[]    findAll()
 * @method PaymentCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentCategory::class);
    }

    // /**
    //  * @return PaymentCategory[] Returns an array of PaymentCategory objects
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
    public function findOneBySomeField($value): ?PaymentCategory
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
