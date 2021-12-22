<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

/** @Embeddable */
class CompanyName
{
    /** @Column(type = "string", nullable=true) */
    private $line1;

    /** @Column(type = "string", nullable=true) */
    private $line2;

    public function __toString()
    {
        return $this->getLine1() ?? '';
    }

    /**
     * @return mixed
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * @param mixed $line1
     */
    public function setLine1($line1): void
    {
        $this->line1 = $line1;
    }

    /**
     * @return mixed
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * @param mixed $line2
     */
    public function setLine2($line2): void
    {
        $this->line2 = $line2;
    }

}
