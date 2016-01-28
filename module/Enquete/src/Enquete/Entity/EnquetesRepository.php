<?php
 namespace Enquete\Entity;
 
 use Doctrine\ORM\EntityRepository;
 
 
 Class EnquetesRepository extends EntityRepository{
 	
 	
 	public function fetchPairs(){
 			
 		$entities = $this->findAll();
 		$array = array();
 			
 		$array[''] = "Selecione uma Enquete";
 		foreach ($entities as $entity){
 	
 			$array[$entity->getId()] = $entity->getTitulo();
 	
 		}
 			
 		return $array;
 	}
 	
 	
 }