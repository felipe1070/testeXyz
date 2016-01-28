<?php
 namespace Enquete\Service;
 
 use Doctrine\ORM\EntityManager;
 use Zend\Stdlib\Hydrator;
 
 use Enquete\Entity\Enquetes as Enquete;
 use Enquete\Entity\Perguntas as Pergunta;
 use Enquete\Entity\Respostas as Resposta;
 
 class Insert{
 	
 	protected $em;
 	
 	public function __construct(EntityManager $em){
		
		$this->em = $em;
	}
	
	
	public function insert(array $data){
		
		$enquete = array("titulo"=>$data['titulo']);
		unset($data['titulo']);
		
		try{
			
			$enquete_entity  =  new Enquete($enquete);
			$this->em->persist($enquete_entity);
			
			
			
			
			if(!empty($data)){
				
				foreach ($data as $key =>$value){
					
					$array = array(
							'pergunta' => $data[$key]['pergunta'],
							'enquetes' => $enquete_entity
					);
					$pergunta_entity  =  new Pergunta($array);
					$this->em->persist($pergunta_entity);
					
					
					
					if(isset($data[$key]['respostas'])){
						
						foreach ($data[$key]['respostas'] as $key2 =>$value2){
							
							$array = array(
									'resposta'=> $value2,
									'perguntas'=> $pergunta_entity
							);
							
							$resposta_entity = new Resposta($array);
							$this->em->persist($resposta_entity);
							
						}
					}
					
				}
			}
			
			$this->em->flush();
			
			return true;
			
		}catch (Exception $e){
			
			$this->em->getConnection()->rollBack();
			return false;
		}
			
		
		
	}
 	
 	
 }