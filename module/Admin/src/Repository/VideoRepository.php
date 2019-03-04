<?php
namespace Admin\Repository;

use Admin\Entity\Video;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Video entity.
 */
class VideoRepository extends EntityRepository
{
    public function findAllVideo($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('v')->from(Video::class, 'v');
        $queryBuilder->orderBy('v.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }

    public function getByResId($res_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('v')->from(Video::class, 'v');
        $queryBuilder->where('v.res_id = :res_id')->setParameter('res_id', $res_id);
        $queryBuilder->orderBy('v.date', 'ASC');

        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res;
    }
}