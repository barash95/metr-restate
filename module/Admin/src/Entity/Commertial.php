<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 05.03.2019
 * Time: 14:03
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a commertial .
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\CommertialRepository")
 * @ORM\Table(name="commertial")
 */

class Commertial
{
    const FREE                   = 0;
    const BOOKED                 = 1;
    const SOLD_OUT               = 2;

    const FINISH                 = 1;
    const NOT_FINISH             = 0;

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="res_id")
     */
    protected $res_id;

    /**
     * @ORM\Column(name="house")
     */
    protected $house;

    /**
     * @ORM\Column(name="floor")
     */
    protected $floor;

    /**
     * @ORM\Column(name="section")
     */
    protected $section;

    /**
     * @ORM\Column(name="number")
     */
    protected $number;

    /**
     * @ORM\Column(name="square")
     */
    protected $square;

    /**
     * @ORM\Column(name="price")
     */
    protected $price;

    /**
     * @ORM\Column(name="height")
     */
    protected $height;

    /**
     * @ORM\Column(name="finish")
     */
    protected $finish;

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

    public function getResId()
    {
        return $this->res_id;
    }

    public function setResId($res_id)
    {
        $this->res_id = $res_id;
    }

    public function getHouse()
    {
        return $this->house;
    }

    public function setHouse($house)
    {
        $this->house = $house;
    }

    public function getFloor()
    {
        return $this->floor;
    }

    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    public function getSection()
    {
        return $this->section;
    }

    public function setSection($section)
    {
        $this->section = $section;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getSquare()
    {
        return $this->square;
    }

    public function setSquare($square)
    {
        $this->square = $square;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getFinish()
    {
        return $this->finish;
    }

    public function setFinish($finish)
    {
        $this->finish = $finish;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getSquarePrice(){
        if ($this->getResidentalSquare()==0)
            return 0;
        else
            return floor($this->getPrice() / $this->getSquare());
    }

    public static function getStateList()
    {
        return [
            self::FREE => 'Помещение свободно',
            self::BOOKED => 'Помещение забронировано',
            self::SOLD_OUT => 'Помещение продано'
        ];
    }

    public static function getFinishList()
    {
        return [
            self::FINISH => 'С отделкой',
            self::NOT_FINISH => 'Без отделки',
        ];
    }

    public function getFinishAsString()
    {
        $list = self::getFinishList();
        if (isset($list[$this->finish]))
            return $list[$this->finish];

        return 'Не найден';
    }

    public function getStateAsString()
    {
        $list = self::getStateList();
        if (isset($list[$this->state]))
            return $list[$this->state];

        return 'Не найден';
    }

    public function getPlan(){
        $plan = "/data/flats/".$this->getId()."/plan.jpeg";
        //if (file_exists("/var/www/restate/public".$plan))
        return $plan;
        // else
        //   return "/main/images/content/no-plan.jpg";
    }
}