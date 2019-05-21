<?php
namespace Admin\Repository;

use Admin\Entity\Order;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for News entity.
 */
class OrderRepository extends EntityRepository
{
    public function findAllOrder($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('o')->from(Order::class, 'o');
        $queryBuilder->orderBy('o.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }
}