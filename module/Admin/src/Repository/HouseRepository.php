<?php
namespace Admin\Repository;

use Admin\Entity\House;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for House entity.
 */
class HouseRepository extends EntityRepository
{
    public function findAllHouse($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('h')->from(House::class, 'h');
        $queryBuilder->orderBy('h.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }

    public function getFlatInHouse($res_id = null, $house = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('h.total_flat')->from(House::class, 'h');
        $queryBuilder->where('h.res_id = :res_id')->setParameter('res_id', $res_id);
        $queryBuilder->andWhere('h.house = :house')->setParameter('house', $house);
        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res[0]['total_flat'];
    }

    public function getHouseByResId($res_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('h')->from(House::class, 'h');
        $queryBuilder->where('h.res_id = :res_id')->setParameter('res_id', $res_id);
        $queryBuilder->orderBy('h.house', 'ASC');

        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res;
    }

}