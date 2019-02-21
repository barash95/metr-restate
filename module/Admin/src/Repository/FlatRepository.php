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
}