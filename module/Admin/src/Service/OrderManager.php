<?php

namespace Admin\Service;

use Admin\Entity\Order;

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
     * @param $data
     * @return Order
     */
    public function addOrder($data)
    {
        $order = new Order();


        $order->setName($data['name']);
        $order->setPhone($data['phone']);
        $order->setAsk('not');
        $order->setResId(0);
        $order->setFlatId(0);
        $order->setState(0);

        $order->setDate(date('Y-m-d H:i:s', time()));

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

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

}