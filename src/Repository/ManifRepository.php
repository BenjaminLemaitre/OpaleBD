<?php

namespace App\Repository;

use App\Classe\Search_agenda;
use App\Entity\Manif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Manif>
 *
 * @method Manif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manif[]    findAll()
 * @method Manif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manif::class);
    }

    public function save(Manif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Manif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Manif[] Returns an array of Manif objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Manif
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    /**
    * @return Manif[] Returns an array of Manif objects
    */
    public function findByManif($data): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.name LIKE :data')
            ->setParameter('data', "%{$data}%")
            ->andWhere('m.name != :none')
            ->setParameter('none', "none")
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Manif[] Returns an array of Manif objects
    */
    public function findByAgenda(): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Manif[] Returns an array of Product objects
    */
    public function findWithSearch(Search_agenda $search)
    {

        $query = $this
            ->createQueryBuilder('m')
            ->select('c', 'm')
            ->join('m.categorie', 'c');

        if (!empty($search->categorie)) {
            $query = $query
                ->andWhere('c.id IN (:categorie)')
                ->setParameter('categorie', $search->categorie);
        }

        if (!empty($search->string)) {
            $query = $query
                ->andWhere('m.name LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }

        return $query->getQuery()->getResult();

    }

}

