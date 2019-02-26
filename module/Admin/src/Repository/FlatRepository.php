<?php
namespace Admin\Repository;

use Admin\Entity\Flat;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Flat entity.
 */
class FlatRepository extends EntityRepository
{
    public function findAllFlat($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f')->from(Flat::class, 'f');
        $queryBuilder->orderBy('f.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }

    public function getFlatList($res_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f.id', 'f.ex_id')->from(Flat::class, 'f');

        if (!is_null($res_id))
            $queryBuilder->where('f.res_id = :res_id')->setParameter('res_id', $res_id);

        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res;
    }

    public function findByExId($res_id, $ex_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f')->from(Flat::class, 'f');

        $queryBuilder->where('f.res_id = :res_id')->setParameter('res_id', $res_id);
        $queryBuilder->andWhere('f.ex_id = :ex_id')->setParameter('ex_id', $ex_id);

        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res;
    }

    public function getFlatInHouse($res_id = null, $house = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f')->from(Flat::class, 'f');
        $queryBuilder->where('f.res_id = :res_id')->setParameter('res_id', $res_id);
        $queryBuilder->andWhere('f.house = :house')->setParameter('house', $house);
        $query = $queryBuilder->getQuery();
        $res = $query->execute();
        return count($res);
    }
}