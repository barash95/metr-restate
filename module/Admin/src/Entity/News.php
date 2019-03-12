<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 13:49
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a news.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\NewsRepository")
 * @ORM\Table(name="news")
 */
class News
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
    protected $tittle;

    /**
     * @ORM\Column(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="date")
     */
    protected $date;

    /**
     * @ORM\Column(name="res_id")
     */
    protected $res_id;

    /**
     * Returns news ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets news ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
        if($res_id != 0)
        $this->res_id = $res_id;
    }


}