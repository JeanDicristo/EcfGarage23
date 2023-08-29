<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

/**
 * Récupère les produits en lien avec une recherche
 * @return Product []
 */
    public function findSearch(SearchData $search):  array
    {
        $query = $this
        ->createQueryBuilder('p')
        ->select('c', 'p')
        ->join('p.brands', 'c');

        if (!empty($search->q)) {
            $query = $query
            ->andWhere('p.name LIKE :q')
            ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->min)) {
            $query = $query
            ->andWhere('p.price >=  :min')
            ->setParameter('min', $search->min);
        }

        if (!empty($search->max)) {
            $query = $query
            ->andWhere('p.price <=  :max')
            ->setParameter('max', $search->max);
        }

        if (!empty($search->promo)) {
            $query = $query
            ->andWhere('p.promo = 1');
        }

        if (!empty($search->brands)) {
            $query = $query
            ->andWhere('c.id IN (:brands)')
            ->setParameter('brands', $search->brands);
        }



        return  $query->getQuery()->getResult();
    }
//    /**
//     * @return Product[] Returns an array of Product objects
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

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
