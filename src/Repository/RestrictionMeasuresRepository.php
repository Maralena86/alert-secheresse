<?php

namespace App\Repository;

use App\Entity\RestrictionMeasures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RestrictionMeasures>
 *
 * @method RestrictionMeasures|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestrictionMeasures|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestrictionMeasures[]    findAll()
 * @method RestrictionMeasures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestrictionMeasuresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestrictionMeasures::class);
    }

    public function save(RestrictionMeasures $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RestrictionMeasures $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RestrictionMeasures[] Returns an array of RestrictionMeasures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RestrictionMeasures
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
