<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuadrado
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CuadradoRepository")
 */
class Cuadrado extends Fig
{
    /**
     * @var int
     *
     * @ORM\Column(name="lado", type="integer")
     */
    private $lado;

    public function __construct() {
        $this->numLados = 4;
    }
    
    public function getArea() {
        return pow($this->lado, 2);
    }
    
    public function getPerimetro(){
        return $this->lado * 4;
    }

    /**
     * Set lado
     *
     * @param integer $lado
     *
     * @return Cuadrado
     */
    public function setLado($lado)
    {
        $this->lado = $lado;

        return $this;
    }

    /**
     * Get lado
     *
     * @return int
     */
    public function getLado()
    {
        return $this->lado;
    }

    public function printr(){
        return 'Lado: ' . $this->lado;
    }
    
    
}
