<?php

namespace App\Repository;

use App\Entity\Admin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Pagerfanta\Pagerfanta;
use phpDocumentor\Reflection\Utils;

/**
 * @extends ServiceEntityRepository<Admin>
 *
 * @method Admin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admin[]    findAll()
 * @method Admin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminRepository extends ServiceEntityRepository
{
    private $paginator;
    public function __construct(ManagerRegistry $registry,PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
        parent::__construct($registry, Admin::class);
    }

    public function add(Admin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Admin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAdminParNom($nom = '',$page = 1):PaginationInterface
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a.id,a.nom,a.createdAt,a.prenom,a.email,a.actif')
            ->where($qb->expr()->isNull('a.deletedAt'))
            //->andWhere($qb->expr()->not('a.id=:user'))
            ->andWhere($qb->expr()->like('a.nom',':nom'))
            ->orWhere($qb->expr()->like('a.prenom',':nom'))

            ->setParameter('nom','%'.$nom.'%');

        return $this->paginator->paginate($qb,$page,2);
    }
}
