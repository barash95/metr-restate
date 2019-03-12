<?php
namespace Admin\Repository;

use Admin\Entity\Commertial;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Commertial entity.
 */
class CommertialRepository extends EntityRepository
{
    public function findAllCommertial($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('c')->from(Commertial::class, 'c');
        $queryBuilder->orderBy('c.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }

}