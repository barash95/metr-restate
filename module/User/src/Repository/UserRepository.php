<?php
namespace User\Repository;
use Doctrine\ORM\EntityRepository;
use User\Entity\User;

/**
 * This is the custom repository class for User entity.
 */
class UserRepository extends EntityRepository
{
  /**
   * Retrieves all users in descending id order.
   * @return Query
   */
  public function findAllUsers($status = -1, $name = '', $order = 0, $role = -1)
  {
    $entityManager = $this->getEntityManager();

    $queryBuilder = $entityManager->createQueryBuilder();

    $queryBuilder->select('u')
                 ->from(User::class, 'u');

    if ($status > -1) {
      $queryBuilder = $queryBuilder->where('u.status = :status');
      $queryBuilder->setParameter('status', $status);
    }

    if ($role > -1) {
      $queryBuilder = $queryBuilder->andWhere('u.role = :role');
      $queryBuilder->setParameter('role', $role);
    }


    //echo $queryBuilder->getQuery()->getSQL();
    //exit();
    return $queryBuilder->getQuery();
  }
}