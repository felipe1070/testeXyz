<?php

namespace Enquete\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Respostas
 *
 * @ORM\Table(name="Respostas", indexes={@ORM\Index(name="fk_Respostas_Perguntas1_idx", columns={"Perguntas_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Enquete\Entity\RespostasRepository")
 */
class Respostas
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
     * @ORM\Column(name="resposta", type="string", length=255, nullable=true)
     */
    private $resposta;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="bigint", nullable=false)
     */
    private $numero;

    /**
     * @var \Perguntas
     *
     * @ORM\ManyToOne(targetEntity="Perguntas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Perguntas_id", referencedColumnName="id")
     * })
     */
    private $perguntas;
    
    public function __construct(array $options = array()){
    	(new Hydrator\ClassMethods)->hydrate($options, $this);
    	 
    	$this->numero = 0;
    	
    }
    
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getResposta() {
		return $this->resposta;
	}
	
	public function setResposta($resposta) {
		$this->resposta = $resposta;
		return $this;
	}
	
	public function getNumero() {
		return $this->numero;
	}
	
	public function setNumero( $numero) {
		$this->numero = $numero;
		return $this;
	}
	
	public function getPerguntas() {
		return $this->perguntas;
	}
	
	public function setPerguntas($perguntas) {
		$this->perguntas = $perguntas;
		return $this;
	}
	
	public function toArray(){
	
		return (new Hydrator\ClassMethods())->extract($this);
	}
	


}

