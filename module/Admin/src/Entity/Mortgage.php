<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 14:02
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a mortgage.
 * @ORM\Entity()
 * @ORM\Table(name="ipoteka")
 */
class Mortgage
{
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
     * @ORM\Column(name="percent")
     */
    protected $percent;

    /**
     * @ORM\Column(name="year")
     */
    protected $year;

    /**
     * @ORM\Column(name="money")
     */
    protected $money;

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

    public function setTittle($name)
    {
        $this->name = $name;
    }

    public function getPercent()
    {
        return $this->Percent;
    }

    public function setPercent($percent)
    {
        $this->percent = $percent;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function setMoney($money)
    {
        $this->money = $money;
    }

}