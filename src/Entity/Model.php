<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

/** @Embeddable */
class Model
{

    /** @Column(type = "string", nullable=true) */
    private $height;

    /** @Column(type = "string", nullable=true) */
    private $weight;

    /** @Column(type = "string", nullable=true) */
    private $shoeSize;

    /** @Column(type = "string", nullable=true) */
    private $clothingSize;

    /** @Column(type = "string", nullable=true) */
    private $hairColor;

    /** @Column(type = "string", nullable=true) */
    private $eyeColor;

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getShoeSize()
    {
        return $this->shoeSize;
    }

    /**
     * @param mixed $shoeSize
     */
    public function setShoeSize($shoeSize): void
    {
        $this->shoeSize = $shoeSize;
    }

    /**
     * @return mixed
     */
    public function getClothingSize()
    {
        return $this->clothingSize;
    }

    /**
     * @param mixed $clothingSize
     */
    public function setClothingSize($clothingSize): void
    {
        $this->clothingSize = $clothingSize;
    }

    /**
     * @return mixed
     */
    public function getHairColor()
    {
        return $this->hairColor;
    }

    /**
     * @param mixed $hairColor
     */
    public function setHairColor($hairColor): void
    {
        $this->hairColor = $hairColor;
    }

    /**
     * @return mixed
     */
    public function getEyeColor()
    {
        return $this->eyeColor;
    }

    /**
     * @param mixed $eyeColor
     */
    public function setEyeColor($eyeColor): void
    {
        $this->eyeColor = $eyeColor;
    }

}
