<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({ "figura" = "Fig",
 *                         "cuadrado" = "Cuadrado",
 *                         "triangulo" = "Triangulo",
 *                         "hexagono" = "Hexagono" })
 */
class Fig
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="numLados", type="integer")
     */
    protected $numLados;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Workspace", inversedBy="figuras")
     * @ORM\JoinColumn(name="workspace", referencedColumnName="id")
     */
    private $workspace;
    
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
     * Set numLados
     *
     * @param integer $numLados
     *
     * @return Fig
     */
    public function setNumLados($numLados)
    {
        $this->numLados = $numLados;

        return $this;
    }

    /**
     * Get numLados
     *
     * @return int
     */
    public function getNumLados()
    {
        return $this->numLados;
    }
    
    public function getArea(){ return 0; }
    public function getPerimetro(){ return 0; }
    public function printr(){ return ''; }

    public function whereis(){

        $hasWorkspace = ( empty($this->getWorkspace()) ) ? '' : $this->getWorkspace()->getId() . '*';
        return $hasWorkspace . "  |  " . $this->printr();
    }

    /**
     * Set workspace
     *
     * @param \AppBundle\Entity\Workspace $workspace
     *
     * @return Fig
     */
    public function setWorkspace(\AppBundle\Entity\Workspace $workspace = null)
    {
        $this->workspace = $workspace;

        return $this;
    }

    /**
     * Get workspace
     *
     * @return \AppBundle\Entity\Workspace
     */
    public function getWorkspace()
    {
        return $this->workspace;
    }
}
