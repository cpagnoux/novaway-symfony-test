<?php

namespace App\Repository;

use App\Entity\Bluray;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bluray|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bluray|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bluray[]    findAll()
 * @method Bluray[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlurayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bluray::class);
    }

//    /**
//     * @return Bluray[] Returns an array of Bluray objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bluray
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
