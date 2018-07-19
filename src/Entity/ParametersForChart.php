<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParametersForChartRepository")
 * @ORM\Table(name="parameters_for_charts")
 */
class ParametersForChart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nameZone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nameValue1;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nameValue2;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nameValue3;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nameValue4;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getNameZone(): ?string
    {
        return $this->nameZone;
    }

    public function setNameZone(?string $nameZone): self
    {
        $this->nameZone = $nameZone;

        return $this;
    }

    public function getNameValue1(): ?string
    {
        return $this->nameValue1;
    }

    public function setNameValue1(?string $nameValue1): self
    {
        $this->nameValue1 = $nameValue1;

        return $this;
    }

    public function getNameValue2(): ?string
    {
        return $this->nameValue2;
    }

    public function setNameValue2(?string $nameValue2): self
    {
        $this->nameValue2 = $nameValue2;

        return $this;
    }

    public function getNameValue3(): ?string
    {
        return $this->nameValue3;
    }

    public function setNameValue3(?string $nameValue3): self
    {
        $this->nameValue3 = $nameValue3;

        return $this;
    }

    public function getNameValue4(): ?string
    {
        return $this->nameValue4;
    }

    public function setNameValue4(?string $nameValue4): self
    {
        $this->nameValue4 = $nameValue4;

        return $this;
    }
}
