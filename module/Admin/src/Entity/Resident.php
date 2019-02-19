<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 12:06
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a resident.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\ResidentRepository")
 * @ORM\Table(name="resident")
 */
class Resident
{
    const SELL    = 0;
    const COMING  = 1;
    const SOLD    = 2;

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
     * @ORM\Column(name="tittle")
     */
    protected $tittle;

    /**
     * @ORM\Column(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="tittle1")
     */
    protected $tittle1;

    /**
     * @ORM\Column(name="tittle2")
     */
    protected $tittle2;

    /**
     * @ORM\Column(name="tittle3")
     */
    protected $tittle3;
    /**
     * @ORM\Column(name="description1")
     */
    protected $description1;

    /**
     * @ORM\Column(name="description2")
     */
    protected $description2;

    /**
     * @ORM\Column(name="description3")
     */
    protected $description3;

    /**
     * @ORM\Column(name="metro")
     */
    protected $metro;

    /**
     * @ORM\Column(name="address")
     */
    protected $address;

    /**
     * @ORM\Column(name="housing")
     */
    protected $housing;

    /**
     * @ORM\Column(name="total_flat")
     */
    protected $total_flat;

    /**
     * @ORM\Column(name="state")
     */
    protected $state;

    /**
     * Returns resident ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets resident ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getTittle()
    {
        return $this->tittle;
    }

    public function setTittle($tittle)
    {
        $this->tittle = $tittle;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTittle1()
    {
        return $this->tittle1;
    }

    public function setTittle1($tittle1)
    {
        $this->tittle1 = $tittle1;
    }

    public function getTittle2()
    {
        return $this->tittle2;
    }

    public function setTittle2($tittle2)
    {
        $this->tittle2 = $tittle2;
    }

    public function getTittle3()
    {
        return $this->tittle3;
    }

    public function setTittle3($tittle3)
    {
        $this->tittle3 = $tittle3;
    }

    public function getDescription1()
    {
        return $this->description1;
    }

    public function setDescription1($description1)
    {
        $this->description1 = $description1;
    }

    public function getDescription2()
    {
        return $this->description2;
    }

    public function setDescription2($description2)
    {
        $this->description2 = $description2;
    }

    public function getDescription3()
    {
        return $this->description3;
    }

    public function setDescription3($description3)
    {
        $this->description3 = $description3;
    }

    public function getMetro()
    {
        return $this->metro;
    }

    public function setMetro($metro)
    {
        $this->metro = $metro;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getHousing()
    {
        return $this->housing;
    }

    public function setHousing($housing)
    {
        $this->housing = $housing;
    }

    public function getTotalFlat()
    {
        return $this->total_flat;
    }

    public function setTotalFlat($total_flat)
    {
        $this->total_flat = $total_flat;
    }

    public function getImage(){
        $complex = "/data/complex/".$this->getId()."/complex.jpeg";
        //if (file_exists("/var/www/restate/public".$complex))
            return $complex;
        //else
            //return "/main/images/content/no-complex.jpg";
    }
    public function getImage1(){
        $image = "/data/complex/".$this->getId()."/1.jpeg";
        //if (file_exists("/var/www/restate/public".$image))
            return $image;
        //else
            //return "/main/images/content/no-image.jpg";
    }
    public function getImage2(){
        $image = "/data/complex/".$this->getId()."/2.jpeg";
        //if (file_exists("/var/www/restate/public".$image))
            return $image;
        //else
            //return "/main/images/content/no-image.jpg";
    }
    public function getImage3(){
        $image = "/data/complex/".$this->getId()."/3.jpeg";
        //if (file_exists("/var/www/restate/public".$image))
            return $image;
        //else
            //return "/main/images/content/no-image.jpg";
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
            self::SELL => 'В продаже',
            self::COMING => 'Скоро в продаже',
            self::SOLD => 'Сдан'

        ];
    }

    public function getStateAsString()
    {
        $list = self::getStateList();
        if (isset($list[$this->state]))
            return $list[$this->state];

        return 'Не указан';
    }

}