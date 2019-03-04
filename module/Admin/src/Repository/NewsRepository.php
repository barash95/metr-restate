<?php
namespace Admin\Repository;

use Admin\Entity\News;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for News entity.
 */
class NewsRepository extends EntityRepository
{
    public function findAllNews($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('n')->from(News::class, 'n');
        $queryBuilder->orderBy('n.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }
}