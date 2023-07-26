<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function save(Commande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function mostpopplat()
    {
        //Requête pour obtenir les 3 plats les plus populaires avec querybuilder
        // Version sans FROM

        $qb = $this->createQueryBuilder('c');
    
        $qb
            ->select('COUNT(c.id) AS nbr_vente, p.libelle, p.image, p.id, p.prix')
            ->join('c.details', 'd')
            ->join('d.plat', 'p')
            ->where('c.etat = :etat')
            ->andWhere('p.active = :active')
            ->setParameter('etat', 3)
            ->setParameter('active', true)
            ->groupBy('p.libelle')
            ->orderBy('nbr_vente', 'DESC')
            ->setMaxResults(3);
    
        return $qb->getQuery()->getResult();

        //Avec un FROM et du coup besoin de créer des alias c1 et c2 pour le self join
            // ->select('COUNT(c1.id) AS nbr_vente, p.libelle, p.image, p.id, p.prix')
            // ->from('App\Entity\Commande', 'c2')
            // ->join('c2.details', 'd')
            // ->join('d.plat', 'p')
            // ->where('c1.etat = :etat')
            // ->andWhere('p.active = :active')
            // ->setParameter('etat', 3)
            // ->setParameter('active', true)
            // ->groupBy('p.libelle')
            // ->orderBy('nbr_vente', 'DESC')
            // ->setMaxResults(3);
    }

    //    /**
    //     * @return Commande[] Returns an array of Commande objects
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

    //    public function findOneBySomeField($value): ?Commande
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}