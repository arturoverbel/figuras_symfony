<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hexagono
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HexagonoRepository")
 */
class Hexagono extends Fig
{
    
    /**
     * @var float
     *
     * @ORM\Column(name="radio", type="float")
     */
    private $radio;

    public function __construct() {
        $this->numLados = 6;
    }
    
    public function getArea() {
        $perimetro = $this->getPerimetro();
        $apotema = $this->getApotema();
        return $perimetro * $apotema / 2;
    }
    
    public function getPerimetro(){
        return $this->radio * 6;
    }
    
    public function getApotema(){
        return ($this->radio / 2) * sqrt(3);
    }

    /**
     * Set radio
     *
     * @param float $radio
     *
     * @return Hexagono
     */
    public function setRadio($radio)
    {
        $this->radio = $radio;

        return $this;
    }

    /**
     * Get radio
     *
     * @return float
     */
    public function getRadio()
    {
        return $this->radio;
    }

    public function printr(){
        return '(Radio, Apotema) : (' . $this->radio . ', ' . $this->getApotema() . ")";
    }
}
