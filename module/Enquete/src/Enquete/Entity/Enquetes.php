<?php

namespace Enquete\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Hydrator;



/**
 * Enquetes
 *
 * @ORM\Table(name="Enquetes")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Enquete\Entity\EnquetesRepository")
 */
class Enquetes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;
    
    /**
     * @ORM\OneToMany(targetEntity="Enquete\Entity\Perguntas", mappedBy="enquetes")
     */
    private $perguntas;
    
    public function __construct(array $options = array()){
    	(new Hydrator\ClassMethods)->hydrate($options, $this);
    	$this->perguntas = new ArrayCollection();
    }
    
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
		return $this;
	}
	
	public function getPerguntas() {
		return $this->perguntas;
	}
	public function setPerguntas($perguntas) {
		$this->perguntas = $perguntas;
		return $this;
	}
	
	
	
	
	


}

