<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 14:10
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a house.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\HouseRepository")
 * @ORM\Table(name="housing")
 */

class House
{
    const NOT_SELL                = 0;
    const SELL                    = 1;

    const BUILD                   = 0;
    const FINISH                  = 1;

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
     * @ORM\Column(name="total_flat")
     */
    protected $total_flat;

    /**
     * @ORM\Column(name="year")
     */
    protected $year;

    /**
     * @ORM\Column(name="state")
     */
    protected $state;

    /**
     * @ORM\Column(name="sell")
     */
    protected $sell;

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

    public function getTotalFlat()
    {
        return $this->total_flat;
    }

    public function setTotalFlat($total_flat)
    {
        $this->total_flat = $total_flat;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getSell()
    {
        return $this->sell;
    }

    public function setSell($sell)
    {
        $this->sell = $sell;
    }

    public static function getStateList()
    {
        return [
            self::BUILD => 'Строится',
            self::FINISH => 'Построен'
        ];
    }

    public function getStateAsString()
    {
        $list = self::getStateList();
        if (isset($list[$this->state]))
            return $list[$this->state];

        return 'Не найден';
    }

    public static function getSellList()
    {
        return [
            self::NOT_SELL => 'Не продается',
            self::SELL => 'В продаже'
        ];
    }

    public function getSellAsString()
    {
        $list = self::getSellList();
        if (isset($list[$this->sell]))
            return $list[$this->sell];

        return 'Не найден';
    }

    public function getStatus()
    {
        $list = self::getSellList();
        $finish = self::getStateList();
        if($this->sell == 1)
            return $list[$this->sell];
        else
            return $finish[$this->state];
    }

    public function getStatusNum()
    {
        if($this->sell == 1)
            return $this->sell+2;
        else
            return $this->state+1;
    }



}