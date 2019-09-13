<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }


    /***************************************************************
                    REQUETE RECHERCHE PRODUITS
     ***************************************************************/
    /**
     * @return Products[] Returns an array of Products objects
     */
    public function findAllByBrandColorSizePrice($brand = null, $size = null, $color = null, $min_price = null, $max_price = null)
    {
        $sql = $this->createQueryBuilder('p');

        if (!empty($brand)) {
            $sql->andWhere('p.brand = :brand')
                ->setParameter('brand', $brand);
        }
        if (!empty($size)) {
            $sql->andWhere('p.shoe_size = :size')
                ->setParameter('size', $size);
        }
        if (!empty($color)) {
            $sql->andWhere('p.color = :color')
                ->setParameter('color', $color);
        }

        if (!empty($min_price)) {
            $sql->andWhere('p.price >= :min_price')
                ->setParameter('min_price', $min_price);
        }

        if (!empty($max_price)) {
            $sql->andWhere('p.price <= :max_price')
                ->setParameter('max_price', $max_price);
        }



        return $sql->orderBy('p.id', 'ASC')->getQuery()->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Products
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.exampleField = :val')
        ->setParameter('val', $value)
        ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    */


    /***************************************************************
                    REQUETE SUPPRIMER DES PRODUITS
     ***************************************************************/
    public function deleteProducts($id)
    {
        $query = $this->createQueryBuilder('p')
            ->delete()
            ->where('p.id = :id')

            ->setParameter('id', $id)
            ->getQuery()
            ->execute();

        return $query;
    }
}
