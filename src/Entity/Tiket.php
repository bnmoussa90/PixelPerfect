<?php

namespace App\Entity;

use App\Repository\TiketRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=TiketRepository::class)
 */
class Tiket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * One Student has One Mentor.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * One Student has One Mentor.
     * @ORM\ManyToOne(targetEntity="Statu")
     * @ORM\JoinColumn(name="satatu_id", referencedColumnName="id")
     */
    private $satatu;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     */
    private $description;


    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="TiketDetail", mappedBy="tiket")
     */
    private $detail;

    public function __construct()
    {
        $this->detail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getSatatu()
    {
        return $this->satatu;
    }

    /**
     * @param mixed $satatu
     */
    public function setSatatu($satatu): void
    {
        $this->satatu = $satatu;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }


}
