<?php

namespace App\Repository;

use App\Entity\Profil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Profil>
 *
 * @method Profil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profil[]    findAll()
 * @method Profil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilRepository extends ServiceEntityRepository
{
    private $paginator;
    public function __construct(ManagerRegistry $registry,PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
        parent::__construct($registry, Profil::class);
    }

    public function add(Profil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Profil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getProfilParCriteres(string $nom = '',$page = 1, $minAge, $maxAge,$domaine):PaginationInterface
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p.id,a.nom,a.createdAt,a.prenom,a.email,p.actif,a.gender,a.age,
                            p.experience,p.details,p.prixParHeure,d.nom domaine')

            ->innerJoin('App\Entity\Candidat','a',Join::WITH,'p.candidat=a.id')
            ->innerJoin('App\Entity\Domaine','d',Join::WITH,'p.domaine=d.id')

            ->where($qb->expr()->isNull('a.deletedAt'))
            ->andWhere($qb->expr()->between('a.age',':minAge',':maxAge'))
            //->andWhere($qb->expr()->eq('p.domaine',':domaine'))

            ->andWhere($qb->expr()->like('a.nom',':nom'))

            ->setParameter('nom','%'.$nom.'%')
            ->setParameter('minAge',$minAge)
            ->setParameter('maxAge',$maxAge);

            //->setParameter('domaine',$domaine)

        return $this->paginator->paginate($qb,$page, 2);
    }
}
