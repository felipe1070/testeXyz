<?php

namespace Enquete\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\Math\Rand,
	Zend\Crypt\Key\Derivation\Pbkdf2;

use Zend\Stdlib\Hydrator;

/**
 * SonuserUsers
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Enquete\Entity\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    

    

    
    
    public function __construct(array $options = array()){
    	
    	
    	(new Hydrator\ClassMethods)->hydrate($options, $this);
    	
    	
    	
    }
    
    
    public function getId() {
    	return $this->id;
    }
    public function setId( $id) {
    	$this->id = $id;
    	return $this;
    }
    public function getNome() {
    	return $this->nome;
    }
    public function setNome($nome) {
    	$this->nome = $nome;
    	return $this;
    }
    public function getEmail() {
    	return $this->email;
    }
    public function setEmail($email) {
    	$this->email = $email;
    	return $this;
    }
    public function getPassword() {
    	return $this->password;
    }
    public function setPassword($password) {
    	$this->password = $this->encriptyPassword($password);
    	return $this;
    }
    
    public function encriptyPassword($password){
    
    	return base64_encode(Pbkdf2::calc("sha256", $password, null, 10000, strlen($password * 2)));
    }
    
    
    
	
	
	public function toArray(){
		
		return (new Hydrator\ClassMethods())->extract($this);
	}
	
	
	


}

