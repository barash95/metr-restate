<?php
namespace Admin\Repository;

use Admin\Entity\Commertial;
use Admin\Entity\Resident;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Commertial entity.
 */
class CommertialRepository extends EntityRepository
{
    protected function prepareQueryBuiler(&$queryBuilder, $filter)
    {
        $filter = array_filter($filter);

        $array_res = array();
        if (!isset($filter['metro'])) $filter['metro'] = array();
        if (!isset($filter['region'])) $filter['region'] = array();

        if (isset($filter['resident']))
            $array_res = array_filter(explode(",", $filter['resident']));
        else if(count($filter['metro']) > 0 || count($filter['region']) > 0) {
            $newEntityManager = $this->getEntityManager();
            $newQueryBuilder = $newEntityManager->createQueryBuilder();
            $newQueryBuilder->select('r.id')->from(Resident::class, 'r');
            $newQueryBuilder->where('r.metro IN (:metro)')->setParameter('metro', $filter['metro']);
            $newQueryBuilder->orWhere('r.region IN (:region)')->setParameter('region', $filter['region']);
            $metro = $newQueryBuilder->getQuery()->execute();

            if((isset($filter['metro']) && is_array($filter['metro'])) || (isset($filter['region']) && is_array($filter['region']))){
                foreach ($metro as $m)
                    $array_res[] = $m;
            }
        }

        if (isset($filter['id'])) {
            $ids = explode(",", $filter['id']);
            $queryBuilder->andWhere('c.id IN (:id)')->setParameter('id', $ids);
        }
        if (isset($filter['not_id'])) {
            $ids = explode(",", $filter['not_id']);
            $queryBuilder->andWhere('c.id NOT IN (:id)')->setParameter('id', $ids);
        }
        if (count($array_res) > 0) {
            $queryBuilder->andWhere('c.res_id IN (:res_id)')->setParameter('res_id', $array_res);
        }
        if (isset($filter['number_min'])) {
            $queryBuilder->andWhere('c.number >= :number_min')->setParameter('number_min', $filter['number_min']);
        }
        if (isset($filter['number_max'])) {
            $queryBuilder->andWhere('c.number <= :number_max')->setParameter('number_max', $filter['number_max']);
        }
        if (isset($filter['square_min'])) {
            $queryBuilder->andWhere('c.square >= :square_min')->setParameter('square_min', $filter['square_min']);
        }
        if (isset($filter['square_max'])) {
            $queryBuilder->andWhere('c.square <= :square_max')->setParameter('square_max', $filter['square_max']);
        }
        if (isset($filter['year'])) {
            $queryBuilder->andWhere('c.year = :year')->setParameter('year', $filter['year']);
        }
        if (isset($filter['price_min'])) {
            $queryBuilder->andWhere('c.price >= :price_min')->setParameter('price_min', $filter['price_min']);
        }
        if (isset($filter['price_max'])) {
            $queryBuilder->andWhere('c.price <= :price_max')->setParameter('price_max', $filter['price_max']);
        }
        if (isset($filter['state'])) {
            $queryBuilder->andWhere('c.state = :state')->setParameter('state', $filter['state']);
        }
    }

    public function findAllCommertial($filter, $limit = null, $state = -1)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('c')->from(Commertial::class, 'c');
        $queryBuilder->orderBy('c.id', 'DESC');
        if($state > -1)
            $queryBuilder->andWhere('c.state = :state')->setParameter('state', $state);

        $this->prepareQueryBuiler($queryBuilder, $filter);

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }

    public function findHouse($res, $limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('c.house')->from(Commertial::class, 'c')
            ->distinct();
        $queryBuilder->andWhere('c.state = :state')->setParameter('state', 0);
        $queryBuilder->andWhere('c.res_id = :res_id')->setParameter('res_id', $res);

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        $query = $queryBuilder->getQuery();
        $res = $query->execute();
        $result = [];
        foreach ($res as $r)
            $result[] = $r['house'];

        return $result;
    }

}