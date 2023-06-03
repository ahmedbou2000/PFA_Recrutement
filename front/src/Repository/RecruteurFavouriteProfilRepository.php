<?php

namespace App\Repository;

use App\Entity\RecruteurFavouriteProfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecruteurFavouriteProfil>
 *
 * @method RecruteurFavouriteProfil|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecruteurFavouriteProfil|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecruteurFavouriteProfil[]    findAll()
 * @method RecruteurFavouriteProfil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecruteurFavouriteProfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecruteurFavouriteProfil::class);
    }

    public function add(RecruteurFavouriteProfil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecruteurFavouriteProfil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RecruteurFavouriteProfil[] Returns an array of RecruteurFavouriteProfil objects
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

//    public function findOneBySomeField($value): ?RecruteurFavouriteProfil
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
