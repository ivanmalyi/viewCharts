<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Skid9Repository")
 */
class Skid9
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $k1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $k2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $k3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $k4;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $k5;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tVar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vesVar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $b1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $b2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $b3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getK1(): ?int
    {
        return $this->k1;
    }

    public function setK1(?int $k1): self
    {
        $this->k1 = $k1;

        return $this;
    }

    public function getK2(): ?int
    {
        return $this->k2;
    }

    public function setK2(?int $k2): self
    {
        $this->k2 = $k2;

        return $this;
    }

    public function getK3(): ?int
    {
        return $this->k3;
    }

    public function setK3(?int $k3): self
    {
        $this->k3 = $k3;

        return $this;
    }

    public function getK4(): ?int
    {
        return $this->k4;
    }

    public function setK4(?int $k4): self
    {
        $this->k4 = $k4;

        return $this;
    }

    public function getK5(): ?int
    {
        return $this->k5;
    }

    public function setK5(?int $k5): self
    {
        $this->k5 = $k5;

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

    public function getVesVar(): ?int
    {
        return $this->vesVar;
    }

    public function setVesVar(?int $vesVar): self
    {
        $this->vesVar = $vesVar;

        return $this;
    }

    public function getB1(): ?int
    {
        return $this->b1;
    }

    public function setB1(?int $b1): self
    {
        $this->b1 = $b1;

        return $this;
    }

    public function getB2(): ?int
    {
        return $this->b2;
    }

    public function setB2(?int $b2): self
    {
        $this->b2 = $b2;

        return $this;
    }

    public function getB3(): ?int
    {
        return $this->b3;
    }

    public function setB3(?int $b3): self
    {
        $this->b3 = $b3;

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
