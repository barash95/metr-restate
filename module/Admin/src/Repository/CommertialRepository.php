<?php
namespace Admin\Repository;

use Admin\Entity\Commertial;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Commertial entity.
 */
class CommertialRepository extends EntityRepository
{
    protected function prepareQueryBuiler(&$queryBuilder, $filter)
    {
        $filter = array_filter($filter);


        if (isset($filter['resident_com']))
            $array_res = array_filter(explode(",", $filter['resident_com']));
        else
            $array_res = array();
        if (isset($filter['resident_com']))
            $array_res[] = $filter['resident_com'];


        if (isset($filter['id_com'])) {
            $ids = explode(",", $filter['id_com']);
            $queryBuilder->andWhere('c.id IN (:id)')->setParameter('id', $ids);
        }
        if (isset($filter['not_id_com'])) {
            $ids = explode(",", $filter['not_id_com']);
            $queryBuilder->andWhere('c.id NOT IN (:id)')->setParameter('id', $ids);
        }
        if (count($array_res) > 0) {
            $queryBuilder->andWhere('c.res_id IN (:res_id)')->setParameter('res_id', $array_res);
        }
        if (isset($filter['number_min_com'])) {
            $queryBuilder->andWhere('c.number >= :number_min')->setParameter('number_min', $filter['number_min_com']);
        }
        if (isset($filter['number_max_com'])) {
            $queryBuilder->andWhere('c.number <= :number_max')->setParameter('number_max', $filter['number_max_com']);
        }
        if (isset($filter['square_min_com'])) {
            $queryBuilder->andWhere('c.square >= :square_min')->setParameter('square_min', $filter['square_min_com']);
        }
        if (isset($filter['square_max_com'])) {
            $queryBuilder->andWhere('c.square <= :square_max')->setParameter('square_max', $filter['square_max_com']);
        }
        if (isset($filter['floor_com'])) {
            $queryBuilder->andWhere('c.floor = :floor')->setParameter('floor', $filter['floor_com']);
        }
        if (isset($filter['year_com'])) {
            $queryBuilder->andWhere('c.year = :year')->setParameter('year', $filter['year_com']);
        }
        if (isset($filter['price_min_com'])) {
            $queryBuilder->andWhere('c.price >= :price_min')->setParameter('price_min', $filter['price_min_com']);
        }
        if (isset($filter['price_max_com'])) {
            $queryBuilder->andWhere('c.price <= :price_max')->setParameter('price_max', $filter['price_max_com']);
        }
        if (isset($filter['state_com'])) {
            $queryBuilder->andWhere('c.state = :state')->setParameter('state', $filter['state_com']);
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

}