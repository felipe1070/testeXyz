<?php


namespace Enquete\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Hydrator;

/**
 * Perguntas
 *
 * @ORM\Table(name="Perguntas", indexes={@ORM\Index(name="fk_Perguntas_Enquetes_idx", columns={"Enquetes_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Enquete\Entity\PerguntasRepository")
 */
class Perguntas
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
     * @ORM\Column(name="pergunta", type="string", length=255, nullable=false)
     */
    private $pergunta;

        
    /**
     * @ORM\ManyToOne(targetEntity="Enquete\Entity\Enquetes", inversedBy="Perguntas")
     * @ORM\JoinColumn(name="Enquetes_id", referencedColumnName="id")
     */
    private $enquetes;
    
    /**
     * @ORM\OneToMany(targetEntity="Enquete\Entity\Respostas", mappedBy="perguntas")
     */
    private $respostas;
    
        
    public function __construct(array $options = array()){
    	(new Hydrator\ClassMethods)->hydrate($options, $this);
    	
    	$this->respostas = new ArrayCollection();
    }
    
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getPergunta() {
		return $this->pergunta;
	}
	
	public function setPergunta($pergunta) {
		$this->pergunta = $pergunta;
		return $this;
	}
	
	public function getEnquetes() {
		return $this->enquetes;
	}
	
	public function setEnquetes($enquetes) {
		$this->enquetes = $enquetes;
		return $this;
	}
	
	public function getRespostas() {
		return $this->respostas;
	}
	


}

