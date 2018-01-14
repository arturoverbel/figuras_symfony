<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Workspace
 *
 * @ORM\Table(name="workspace")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkspaceRepository")
 */
class Workspace
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="limiteFiguras", type="integer")
     */
    private $limiteFiguras;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Fig", mappedBy="workspace")
     */
    private $figuras;
    
    public function __construct() {
        $this->figuras = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Workspace
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set limiteFiguras
     *
     * @param integer $limiteFiguras
     *
     * @return Workspace
     */
    public function setLimiteFiguras($limiteFiguras)
    {
        $this->limiteFiguras = $limiteFiguras;

        return $this;
    }

    /**
     * Get limiteFiguras
     *
     * @return int
     */
    public function getLimiteFiguras()
    {
        return $this->limiteFiguras;
    }

    /**
     * Add figura
     *
     * @param \AppBundle\Entity\Fig $figura
     *
     * @return Workspace
     */
    public function agregarFigura(\AppBundle\Entity\Fig $figura)
    {
        $this->figuras[] = $figura;

        return $this;
    }

    /**
     * Remove figura
     *
     * @param \AppBundle\Entity\Fig $figura
     */
    public function eliminarFigura(\AppBundle\Entity\Fig $figura)
    {
        $this->figuras->removeElement($figura);
    }

    /**
     * Get figuras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiguras()
    {
        return $this->figuras;
    }
    
    public function isLleno(){
        $total = count( $this->figuras );
        return ($total >= $this->limiteFiguras ) ? true : false;
    }
    
    public function getAreaTotal(){
        $areas = 0;
        foreach ($this->figuras as $figura) {
            $areas += $figura->getArea();
        }
        return $areas;
    }
    
    public function getApotemaTotal(){
        
        $apotemas = 0;
        foreach ($this->figuras as $figura) {
            if( $figura->getNumLados() == 6 )
            $apotemas += $figura->getApotema();
        }
        return $apotemas;
    }
    
}
