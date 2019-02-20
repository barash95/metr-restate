<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 14:19
 */

namespace Admin\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a flat.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\FlatRepository")
 * @ORM\Table(name="flats")
 */
class Flat
{
    const FREE                   = 0;
    const AGENCY_BOOKED          = 1;
    const OPERATOR_BOOKED        = 2;
    const SOLD_OUT               = 3;
    const NOT_AVAILABLE          = 4;

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="external_id")
     */
    protected $ex_id;

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
     * @ORM\Column(name="size")
     */
    protected $size;

    /**
     * @ORM\Column(name="square")
     */
    protected $square;

    /**
     * @ORM\Column(name="price")
     */
    protected $price;

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

    public function getExId()
    {
        return $this->ex_idid;
    }

    public function setExId($ex_id)
    {
        $this->ex_id = $ex_id;
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

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
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
            self::FREE => 'Квартира свободна',
            self::AGENCY_BOOKED => 'Квартира забронирована агентством',
            self::OPERATOR_BOOKED => 'Квартира забронирована менеджером',
            self::SOLD_OUT => 'Квартира продана',
            self::NOT_AVAILABLE => 'Квартира снята с продажи'
        ];
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

    public function getSizeAsString()
    {
        return ($this->size==0)?"Студия":$this->size;
    }

    public function getSizeTxt()
    {
        switch ($this->getSize()) {
            case 0:
                return "Студия";
                break;
            case 1:
                return "Однокомнатная квартира";
                break;
            case 2:
                return "Двухкомнатная квартира";
                break;
            case 3:
                return "Трехкомнатная квартира";
                break;
            case 4:
                return "Четырехкомнатная квартира";
                break;
            case 5:
                return "Пятикомнатная квартира";
                break;
            default:
                return "Многокомнатная квартира";
                break;
        }
    }
}
