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



}