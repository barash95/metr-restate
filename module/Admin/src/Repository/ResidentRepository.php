<?php
namespace Admin\Repository;

use Admin\Entity\Resident;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Resident entity.
 */
class ResidentRepository extends EntityRepository
{
    public function findAllResident($limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('r')->from(Resident::class, 'r');
        $queryBuilder->orderBy('r.id', 'DESC');

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }
}