<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Triangulo
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrianguloRepository")
 */
class Triangulo extends Fig
{
    /**
     * @var int
     *
     * @ORM\Column(name="base", type="integer")
     */
    private $base;

    /**
     * @var int
     *
     * @ORM\Column(name="altura", type="integer")
     */
    private $altura;

    /**
     * @var int
     *
     * @ORM\Column(name="hipotenusa", type="integer")
     */
    private $hipotenusa;

    public function __construct() {
        $this->numLados = 3;
    }
    
    public function init($base, $altura, $hipotenusa){
        $this->base = $base;
        $this->altura = $altura;
        $this->hipotenusa = $hipotenusa;
    }
    
    public function getArea() {
        $semiperimetro = $this->getPerimetro() / 2;
        $base = $semiperimetro * ($semiperimetro-$this->altura) * ($semiperimetro-$this->base) * ($semiperimetro-$this->hipotenusa);
        return sqrt($base);
    }
    
    public function getPerimetro(){
        return $this->altura + $this->base + $this->hipotenusa;
    }

    /**
     * Set base
     *
     * @param integer $base
     *
     * @return Triangulo
     */
    public function setBase($base)
    {
        $this->base = $base;

        return $this;
    }

    /**
     * Get base
     *
     * @return int
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Set altura
     *
     * @param integer $altura
     *
     * @return Triangulo
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get altura
     *
     * @return int
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set hipotenusa
     *
     * @param string $hipotenusa
     *
     * @return Triangulo
     */
    public function setHipotenusa($hipotenusa)
    {
        $this->hipotenusa = $hipotenusa;

        return $this;
    }

    /**
     * Get hipotenusa
     *
     * @return string
     */
    public function getHipotenusa()
    {
        return $this->hipotenusa;
    }
    
    
    
    
}
