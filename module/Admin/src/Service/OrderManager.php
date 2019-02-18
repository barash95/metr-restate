<?php
namespace Flat\Service;

use Zend\Session\Container;
use Flat\Entity\Order;
use User\Entity\User;

/**
 * The OrderManager service is responsible for order management
 */
class OrderManager
{
  /**
   * Doctrine entity manager.
   * @var Doctrine\ORM\EntityManager
   */
  private $entityManager;

  /**
   * Constructs the service.
   */
  public function __construct($entityManager)
  {
    $this->entityManager = $entityManager;
  }

  /**
   * add order to the db
   */
  public function addOrder($data)
  {
    $order = new Order();

    $order->setName($data['name']);
    $order->setPhone($data['phone']);
    $order->setCreatedDate(date('Y-m-d H:i:s', time()));

    if (isset($data['residential_id']))
      $order->setresidentialId($data['residential_id']);
    else
      $order->setresidentialId(2);

    if ($data['notification_name']>'') $order->setNotificationName($data['notification_name']);
    if ($data['virtual_phone_number']>'') $order->setVirtualPhoneNumber($data['virtual_phone_number']);
    if ($data['call_session_id']>'') $order->setCallSessionId($data['call_session_id']);
    if ($data['calling_phone_number']>'') $order->setCallingPhoneNumber($data['calling_phone_number']);
    if ($data['campaing_name']>'') $order->setCampaingName($data['campaing_name']);
    if (isset($data['direction'])){
      $order->setDirection(intval($data['direction']));
    };
    if ($data['employee_id']>'' && $data['employee_id']!='-1'){
      $order->setEmployeeId($data['employee_id']);
      //var_dump($data['employee_id']);

      $user = $this->entityManager->getRepository(User::class)->findOneByExternalUserId($data['employee_id']);
      //var_dump($user);

      $order->setUser($user);
    }

    // Add the entity to the entity manager.
    $this->entityManager->persist($order);

    // Apply changes to database.
    $this->entityManager->flush();

    return $order;
  }

  /**
   * This method updates data of an existing order.
   */
  public function updateOrder($order, $data)
  {
    $order->setPhone($data['phone']);
    $order->setName($data['name']);

    if (isset($data['tag']) && $data['tag']>'')
      $order->setTag($data['tag']);
    else
      $order->setTag(null);

    if (isset($data['admin_comment'])) $order->setAdminComment($data['admin_comment']);
    if (isset($data['manager_comment'])) $order->setManagerComment($data['manager_comment']);

    // Apply changes to database.
    $this->entityManager->flush();

    return true;
  }

  /**
   * This method updates user of an existing order.
   */
  public function updateOrderUser($order, $user_id)
  {
    $user = $this->entityManager->getReference(User::class, $user_id);
    $order->setUser($user);

    // Apply changes to database.
    $this->entityManager->flush();

    return true;
  }
}