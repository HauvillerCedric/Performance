<?php

namespace App\Repository;

use App\Entity\Perfectionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Perfectionnement>
 *
 * @method Perfectionnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perfectionnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perfectionnement[]    findAll()
 * @method Perfectionnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerfectionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perfectionnement::class);
    }

//    /**
//     * @return Perfectionnement[] Returns an array of Perfectionnement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Perfectionnement
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
