<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 16:22
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a video.
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="\Admin\Repository\VideoRepository")
 * @ORM\Table(name="video")
 */
class Video
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
     * @ORM\Column(name="tittle")
     */
    protected $tittle;

    /**
     * @ORM\Column(name="link")
     */
    protected $link;

    /**
     * @ORM\Column(name="date")
     */
    protected $date;

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

    public function getTittle()
    {
        return $this->tittle;
    }

    public function setTittle($tittle)
    {
        $this->tittle = $tittle;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

}