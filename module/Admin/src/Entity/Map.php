<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 13:55
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a map.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\MapRepository")
 * @ORM\Table(name="mapping")
 */
class Map
{
    /**
     * @ORM\Column(name="res_id")
     */
    protected $res_id;

    /**
     * @ORM\Column(name="x_pos")
     */
    protected $x_pos;

    /**
     * @ORM\Column(name="y_pos")
     */
    protected $y_pos;

    public function getResId()
    {
        return $this->res_id;
    }

    public function setResId($res_id)
    {
        $this->res_id = $res_id;
    }

    public function getX()
    {
        return $this->x_pos;
    }

    public function setX($x_pos)
    {
        $this->x_pos = $x_pos;
    }

    public function getY()
    {
        return $this->y_pos;
    }

    public function setY($y_pos)
    {
        $this->y_pos = $y_pos;
    }

    public function getPosition()
    {
        return ['x' => $this->getX(), 'y' => $this->getY()];
    }

}