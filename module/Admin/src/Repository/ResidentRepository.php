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


    public function getResidentList(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('r.id', 'r.name')
            ->distinct()
            ->from(Resident::class, 'r')
            ->orderBy('r.id', 'ASC');

        $query = $queryBuilder->getQuery();
        $res = $query->execute();
        foreach($res as $r)
            $result[$r['id']] = $r['name'];

        return $result;
    }

    public function getNameById($id){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('r.name')->from(Resident::class, 'r');

        $queryBuilder->where('r.id = :id')->setParameter('id', $id);

        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res[0]['name'];
    }
}