<?php
namespace Enquete\Entity;

use Doctrine\ORM\EntityRepository;

Class UserRepository extends EntityRepository{
	
	
	public function findByEmailAndPassword($email, $password){
		
		$user = $this->findOneByEmail($email);
		
		if($user){
			
			if($user->encriptyPassword($password) == $user->getPassword()){
				
				return $user;
			}else{
				
				return false;
			}
			
		}else{
			
			return false;
		}
		
			
			
			
		
	}
	
	
}