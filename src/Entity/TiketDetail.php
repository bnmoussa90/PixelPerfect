<?php

namespace App\Entity;

use App\Repository\TiketDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TiketDetailRepository::class)
 */
class TiketDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * One Student has One Mentor.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * One Student has One Mentor.
     * @ORM\ManyToOne(targetEntity="Tiket")
     * @ORM\JoinColumn(name="tiket_id", referencedColumnName="id")
     */
    private $tiket;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponse;


    public function getId(): ?int
    {
        return $this->id;
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
    public function setUser($user): void
    {
        $this->user = $user;
    }




    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTiket()
    {
        return $this->tiket;
    }

    /**
     * @param mixed $tiket
     */
    public function setTiket($tiket): void
    {
        $this->tiket = $tiket;
    }

}
