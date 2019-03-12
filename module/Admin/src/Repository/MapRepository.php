<?php
namespace Admin\Repository;

use Admin\Entity\Map;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Map entity.
 */
class MapRepository extends EntityRepository
{
    public function findAllMap($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('m')->from(Map::class, 'm');
        $queryBuilder->orderBy('m.res_id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }

    public function findOneByResId($id)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('m.res_id')->from(Map::class, 'm');

        $queryBuilder->where('m.res_id = :id')->setParameter('id', $id);

        $query = $queryBuilder->getQuery();
        $res = $query->execute();
        if(is_array($res) && isset($res[0])) $res = $res[0]; else $res = null;
        return $res;
    }
}