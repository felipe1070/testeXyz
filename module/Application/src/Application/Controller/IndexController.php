<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$container = new Container('enquete');
    	if(!isset($container->enquete)){
    		$container->enquete = array();
    	}
    	$zero = false;
    	$final = false;
    	$enquete = false;
    	$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	$repo = $em->getRepository("Enquete\Entity\Enquetes");
    	$list = $repo->findAll();
    	
    	if(count($list) >0){
    		
    		if(count($container->enquete) == 0){
    			 
    			$enquete = $list[0];
    		}else{
    			
    			 foreach ($list as $key => $value){
    			 	
    			 	if(in_array($value->getId(), $container->enquete)){
    			 		unset($list[$key]);
    			 	}
    			 }
    			 
    			 if(count($list)== 0){
    			 	$final = true;
    			 	
    			 	
    			 }else{
    			 	
    			 	$enquete = array_shift($list);
    			 	
    			 	
    			 }
    			 
    			 
    		}
    		
    	}else{
    		
    		$zero = true;
    	}
	    	
    	
    	
        return new ViewModel(array('enquete'=>$enquete,"zero"=>$zero, "final"=>$final));
    }
    
    
    public function responderAction(){
    	
    	
    	if($this->request->isPost()){
    		
    		$data = $this->request->getPost()->toArray();
    		$id = $data['id'];
    		unset($data['id']);
    		$array = array();
    		foreach ($data as $key => $value){
    			array_push($array, $data[$key]);
    		}
    		
    		if(count($array) == count(array_unique($array))){
    			
    			$service = $this->getServiceLocator()->get("Enquete\Service\Resposta");
    			
    			
    			if($service->increment($array)){
    				
    				
    				$container = new Container('enquete');
    				array_push($container->enquete, $id);
    			}
    			
    			
    		}
    			
    			$this->redirect()->toRoute("application");
    			
    		
    		
    	}
    	
    }
    
    
    public function resetAction(){
    	
    	$container = new Container('enquete');
    	unset($container->enquete);
    	$this->redirect()->toRoute("application");
    }
    
}
