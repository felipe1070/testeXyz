<?php
 namespace Enquete\Service;
 
 use Doctrine\ORM\EntityManager;
use Prophecy\Exception\Exception;



	 
Class Resposta extends AbstractService{
 	
 	
 	
	function __construct(EntityManager $em){
		
		parent::__construct($em);
		$this->entity = "Enquete\Entity\Respostas";
		
	}
 	
 	
	public function insert(array $data){
	
		$entity = new $this->entity($data);
	
		$pergunta =  $this->em->getReference("Enquete\Entity\Perguntas", $data['Perguntas_id']);
	
		$entity->setPerguntas($pergunta);
		$this->em->persist($entity);
		$this->em->flush();
		return $entity;
	}
	
	public function increment(array $data){
		
		$repo = $this->em->getRepository($this->entity);
		
		try{
			
			foreach ($data as $value){
			
			
				$entity = $repo->find($value);
				$numero = $entity->getNumero();
				$numero++;
				$entity->setNumero($numero);
				$this->em->persist($entity);
				
			}
			$this->em->flush();
			return true;
			
		}catch (Exception $e){
			$this->em->getConnection()->rollBack();
			return false;
		
		}
		
	}
	
	
	
 	
 	
 	
 	
 	
 	
 	
 }