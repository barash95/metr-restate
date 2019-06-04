<?php
namespace Admin\Repository;

use Admin\Entity\Sales;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Sales entity.
 */
class SalesRepository extends EntityRepository
{
    public function findAllSales($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('n')->from(Sales::class, 'n');
        $queryBuilder->orderBy('n.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }
}