<?php
 namespace Enquete\Service;
 
 use Doctrine\ORM\EntityManager;



	 
Class Pergunta extends AbstractService{
 	
 	
 	
	function __construct(EntityManager $em){
		
		parent::__construct($em);
		$this->entity = "Enquete\Entity\Perguntas";
		
	}
 	
 	
	public function insert(array $data){
	
		$entity = new $this->entity($data);
	
		$enquete =  $this->em->getReference("Enquete\Entity\Enquetes", $data['Enquetes_id']);
	
		$entity->setEnquetes($enquete);
		$this->em->persist($entity);
		$this->em->flush();
		return $entity;
	}
	
	
	public function delete($id){
		
		$repo = $this->em->getRepository($this->entity);
		
		$result = $repo->find($id);
		
		if($result){
			
			foreach ($result->getRespostas() as $value){
				
				$entity = $this->em->getReference("Enquete\Entity\Respostas", $value->getId());
				$this->em->remove($entity);
			}
			
			$this->em->remove($result);
			$this->em->flush();
			
			return $id;
			
		}
		
	}
 	
 	
 	
 	
 	
 	
 	
 }