<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents an order.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{
  const NOT_SEEN    = 0;
  const SEEN        = 1;
  const ANSWERED    = 2;

  /**
   * @ORM\Id
   * @ORM\Column(name="id")
   * @ORM\GeneratedValue
   */
  protected $id;

  /**
   * @ORM\Column(name="name")
   */
  protected $name;

    /**
     * @ORM\Column(name="ask")
     */
    protected $ask;

  /**
   * @ORM\Column(name="phone")
   */
  protected $phone;

  /**
   * @ORM\Column(name="date")
   */
  protected $date;

  /**
   * @ORM\Column(name="res_id")
   */
  protected $res_id;

    /**
     * @ORM\Column(name="flat_id")
     */
    protected $flat_id;

    /**
     * @ORM\Column(name="state")
     */
    protected $state;


  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getAsk()
  {
    return $this->ask;
  }

  public function setAsk($ask)
  {
    $this->ask = $ask;
  }

  public function getPhone()
  {
      return $this->phone;
  }

  public function setPhone($phone)
  {
    $this->phone = $phone;
  }

  public function getDate()
  {
    return $this->date;
  }

  public function setDate($date)
  {
    $this->date = $date;
  }

    public function getResId()
    {
        return $this->res_id;
    }

    public function setResId($res_id)
    {
        $this->res_id = $res_id;
    }

    public function getFlatId()
    {
        return $this->flat_id;
    }

    public function setFlatId($flat_id)
    {
        $this->flat_id = $flat_id;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

  public static function getStateList()
  {
    return [
      self::NOT_SEEN => 'Не просмотренно',
      self::SEEN => 'Просмотренно',
      self::ANSWERED => 'Отвечено'

    ];
  }

  public function getStateAsString()
  {
    $list = self::getStateList();
    if (isset($list[$this->tag]))
      return $list[$this->tag];

    return 'Не указан';
  }

}
