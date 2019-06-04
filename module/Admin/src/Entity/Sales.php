<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a sales.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\SalesRepository")
 * @ORM\Table(name="sales")
 */
class Sales
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="tittle")
     */
    protected $title;

    /**
     * @ORM\Column(name="subtittle")
     */
    protected $subtitle;

    /**
     * @ORM\Column(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="discount")
     */
    protected $discount;

    /**
     * @ORM\Column(name="time")
     */
    protected $time;

    /**
     * @ORM\Column(name="filter")
     */
    protected $filter;

    /**
     * @ORM\Column(name="res_id")
     */
    protected $res_id;

    /**
     * @return mixed
     */


    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param mixed $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return mixed
     */
    public function getResId()
    {
        return $this->res_id;
    }

    /**
     * @param mixed $res_id
     */
    public function setResId($res_id)
    {
        $this->res_id = $res_id;
    }


}