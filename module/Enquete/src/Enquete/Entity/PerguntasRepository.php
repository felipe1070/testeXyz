<?php
 namespace Enquete\Entity;
 
 use Doctrine\ORM\EntityRepository;
 
 
 Class PerguntasRepository extends EntityRepository{
 	
 	
 	public function getFk($fk){
 		
 		$result = $this->findBy(array("Enquetes_id"=>$fk));
 		return $result;
 		
 	}
 	
 	
 }