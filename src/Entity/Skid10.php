<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Skid10Repository")
 * @ORM\Table(name="skid10")
 */
class Skid10
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tVar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zad;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tSirop;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pSirop;

    /**
     * @ORM\Column(type="integer", nullable=true, name="zad_t_sirop")
     */
    private $zadTSirop;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vakuum;

    /**
     * @ORM\Column(name="string",type="string", length=255, nullable=true)
     */
    private $response;

    public function getId()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTVar(): ?int
    {
        return $this->tVar;
    }

    public function setTVar(?int $tVar): self
    {
        $this->tVar = $tVar;

        return $this;
    }

    public function getZad(): ?int
    {
        return $this->zad;
    }

    public function setZad(?int $zad): self
    {
        $this->zad = $zad;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getTSirop(): ?int
    {
        return $this->tSirop;
    }

    public function setTSirop(?int $tSirop): self
    {
        $this->tSirop = $tSirop;

        return $this;
    }

    public function getZadTSirop(): ?int
    {
        return $this->zadTSirop;
    }

    public function setZadTSirop(?int $zadTSirop): self
    {
        $this->zadTSirop = $zadTSirop;

        return $this;
    }

    public function getPSirop(): ?int
    {
        return $this->pSirop;
    }

    public function setPSirop($pSirop): void
    {
        $this->pSirop = $pSirop;
    }



    public function getVakuum(): ?int
    {
        return $this->vakuum;
    }

    public function setVakuum(?int $vakuum): self
    {
        $this->vakuum = $vakuum;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(?string $response): self
    {
        $this->response = $response;

        return $this;
    }
}
