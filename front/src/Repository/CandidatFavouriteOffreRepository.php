<?php

namespace App\Repository;

use App\Entity\CandidatFavouriteOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CandidatFavouriteOffre>
 *
 * @method CandidatFavouriteOffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatFavouriteOffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatFavouriteOffre[]    findAll()
 * @method CandidatFavouriteOffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatFavouriteOffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidatFavouriteOffre::class);
    }

    public function add(CandidatFavouriteOffre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CandidatFavouriteOffre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CandidatFavouriteOffre[] Returns an array of CandidatFavouriteOffre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CandidatFavouriteOffre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
