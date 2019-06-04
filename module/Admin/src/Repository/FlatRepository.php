<?php

namespace Admin\Repository;

use Admin\Entity\Flat;
use Admin\Entity\Resident;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Flat entity.
 */
class FlatRepository extends EntityRepository
{
    protected function prepareQueryBuiler(&$queryBuilder, $filter)
    {
        $filter = array_filter($filter);
        if (isset($filter['size']) && !is_array($filter['size']))
            $array_size = array_filter(explode(",", $filter['size']));
        else
            $array_size = array();
        if(isset($filter['size']) && is_array($filter['size']))
            $array_size = $filter['size'];
        if (!isset($filter['metro'])) $filter['metro'] = array();
        if (!isset($filter['region'])) $filter['region'] = array();

        $array_res = array();
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
            $queryBuilder->andWhere('f.id IN (:id)')->setParameter('id', $ids);
        }
        if (isset($filter['not_id'])) {
            $ids = explode(",", $filter['not_id']);
            $queryBuilder->andWhere('f.id NOT IN (:id)')->setParameter('id', $ids);
        }
        if (count($array_res) > 0) {
            $queryBuilder->andWhere('f.res_id IN (:res_id)')->setParameter('res_id', $array_res);
        }
        if (isset($filter['number_min'])) {
            $queryBuilder->andWhere('f.number >= :number_min')->setParameter('number_min', $filter['number_min']);
        }
        if (isset($filter['number_max'])) {
            $queryBuilder->andWhere('f.number <= :number_max')->setParameter('number_max', $filter['number_max']);
        }
        if (isset($filter['square_min'])) {
            $queryBuilder->andWhere('f.square >= :square_min')->setParameter('square_min', $filter['square_min']);
        }
        if (isset($filter['square_max'])) {
            $queryBuilder->andWhere('f.square <= :square_max')->setParameter('square_max', $filter['square_max']);
        }
        if (count($array_size) > 0) {
            $queryBuilder->andWhere('f.size IN (:size)')->setParameter('size', $array_size);
        }
        if (isset($filter['floor'])) {
            $queryBuilder->andWhere('f.floor = :floor')->setParameter('floor', $filter['floor']);
        }
        if (isset($filter['year'])) {
            $queryBuilder->andWhere('f.year = :year')->setParameter('year', $filter['year']);
        }
        if (isset($filter['price_min'])) {
            $queryBuilder->andWhere('f.price >= :price_min')->setParameter('price_min', $filter['price_min']);
        }
        if (isset($filter['price_max'])) {
            $queryBuilder->andWhere('f.price <= :price_max')->setParameter('price_max', $filter['price_max']);
        }
        if (isset($filter['state'])) {
            $queryBuilder->andWhere('f.state = :state')->setParameter('state', $filter['state']);
        }
    }

    public function findAllFlat($filter, $limit = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f')->from(Flat::class, 'f');
        $queryBuilder->orderBy('f.id', 'DESC');

        $this->prepareQueryBuiler($queryBuilder, $filter);

        if (!is_null($limit))
            $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery();
    }

    public function getFlatList($res_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f.id', 'f.ex_id')->from(Flat::class, 'f');

        if (!is_null($res_id))
            $queryBuilder->where('f.res_id = :res_id')->setParameter('res_id', $res_id);

        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res;
    }

    public function findByExId($res_id, $ex_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f')->from(Flat::class, 'f');

        $queryBuilder->where('f.res_id = :res_id')->setParameter('res_id', $res_id);
        $queryBuilder->andWhere('f.ex_id = :ex_id')->setParameter('ex_id', $ex_id);

        $query = $queryBuilder->getQuery();
        $res = $query->execute();

        return $res;
    }

    public function getFlatInHouse($res_id = null, $house = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f')->from(Flat::class, 'f');
        $queryBuilder->where('f.res_id = :res_id')->setParameter('res_id', $res_id);
        $queryBuilder->andWhere('f.house = :house')->setParameter('house', $house);
        $query = $queryBuilder->getQuery();
        $res = $query->execute();
        return count($res);
    }



    public function findBestCostFlats($limit = 10, $size, $res_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select("f")->from(Flat::class, "f");
        $queryBuilder->orderBy('f.price', 'ASC');
        $queryBuilder->where('f.size = :size')->setParameter('size', $size);

        if(!is_null($res_id)){
            $queryBuilder->andWhere('f.res_id = :res_id')->setParameter('res_id', $res_id);
        }

        $queryBuilder->setMaxResults($limit);

        $query = $queryBuilder->getQuery();

        $result = $query->execute();

        return $result;
    }

    public function findBestFlats($limit = 10, $res_id = null)
    {
        $f0 = $this->findBestCostFlats(4, 0);
        $f1 = $this->findBestCostFlats(4, 1);
        $f2 = $this->findBestCostFlats(4, 2);
        $f3 = $this->findBestCostFlats(4, 3);

        $result = array_merge($f0, $f1, $f2, $f3);

        return $result;
    }

    public function getFlatCount($res_id = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('f')->from(Flat::class, 'f');
        $queryBuilder->where('f.res_id = :res_id')->setParameter('res_id', $res_id);
        $query = $queryBuilder->getQuery();
        $res = $query->execute();
        return count($res);
    }
}