<?php

namespace Enquete\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Enquete\Form\Enquete as FormEnquete;
use Enquete\Form\Pergunta as FormPergunta;
use Enquete\Form\Resposta as FormResposta;

class IndexController extends AbstractActionController
{
    public function indexAction()    
    {
    	$success = $this->flashmessenger()
    	->setNamespace("success")
    	->getMessages();
    	
    	$error = $this->flashmessenger()
    	->setNamespace("error")
    	->getMessages();
    	
    	$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	$repo = $em->getRepository("Enquete\Entity\Enquetes");
    	$list = $repo->findAll();
    	
        return new ViewModel(array('success'=>$success, "error"=> $error, "list"=>$list));
    }
    
    
    public function newAction(){
    	
    	
    	
    	if($this->request->isPost()){
    		
    		$data = $this->request->getPost()->toArray();
    		
    		$service = $this->getServiceLocator()->get("Enquete\Service\Insert");
    		
    		if($service->insert($this->convert($data))){
    			
    			$this->flashmessenger()
    				->setNamespace("success")
    				->addMessage("Enquete Cadastrada com sucesso");
    		}else{
    			
    			$this->flashmessenger()
    				->setNamespace("error ")
    				->addMessage("Ocorreu algum erro");
    		}	
    		
    		
    		
    		$this->redirect()->toRoute("admin");
    	}
    	
    	
    	return new ViewModel();
    }
    
    
    
    public function detalheAction(){
    	
    	$id = $this->params()->fromRoute("id",0);
    	$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	$repo = $em->getRepository("Enquete\Entity\Enquetes");
    	
    	 
    	
    	$entity = $repo->find($id);
    	
    	if($entity){
    		
    		return new ViewModel(array("entity"=>$entity));
    		
    	}else{
    		
    		$this->redirect()->toRoute("admin");
    	}
    	
    }
    
    public function editAction(){
    	 
    	$id = $this->params()->fromRoute("id",0);
    	$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	$repo = $em->getRepository("Enquete\Entity\Enquetes");
    	 
    	$form_enquete = new FormEnquete();
    	$form_pergunta = new FormPergunta();
    	$form_pergunta2 = new FormPergunta();
    	$form_resposta = new FormResposta();
    	$form_resposta2 = new FormResposta();
    	  
    	 
    	$entity = $repo->find($id);
    	 
    	if($entity){
    		
    		$success = $this->flashmessenger()
    		->setNamespace("success")
    		->getMessages();
    		 
    		$error = $this->flashmessenger()
    		->setNamespace("error")
    		->getMessages();
    
    		return new ViewModel(array("entity"=>$entity,
    							'enquete'=> $form_enquete,
    							'success'=>$success, 
    							"error"=> $error,
    							'pergunta'=> $form_pergunta,
    							'resposta'=> $form_resposta,
    							'resposta2'=> $form_resposta2,
    							'pergunta2'=> $form_pergunta2
    				
    		));
    
    	}else{
    
    		$this->redirect()->toRoute("admin");
    	}
    	 
    }
    
    
    public function deleteEnqueteAction(){
    	
    	if($this->request->isPost()){
    		
    		$data = $this->request->getPost()->toArray();
    		
    		$service  = $this->getServiceLocator()->get("Enquete\Service\Enquete");
    		if($service->delete($data['id_enquete'])){
    			
    			$this->flashmessenger()
    			->setNamespace("success")
    			->addMessage("Registro removido com sucesso");
    		}
    	}
    	
    	$this->redirect()->toRoute("admin");
    	
    	
    }
    
    
    
    public function editEnqueteAction(){
    	
    	
    	if($this->request->isPost()){
    		
    		$form_enquete = new FormEnquete();
    		$data = $this->request->getPost()->toArray();
    		$form_enquete->setData($data);
    		
    		if($form_enquete->isValid()){
    			
    			$service = $this->getServiceLocator()->get("Enquete\Service\Enquete");
    			if($service->update($data)){
    				$this->flashmessenger()
    				->setNamespace("success")
    				->addMessage("Registro alterado com sucesso");
    				
    			}else{
    				
    				$this->flashmessenger()
    				->setNamespace("error")
    				->addMessage("Erro de validação");
    			}
    			
    		}else{
    			
    			$this->flashmessenger()
    			->setNamespace("error")
    			->addMessage("Erro de validação");
    		}
    		
    		$this->redirect()->toRoute("admin/default", array("controller"=>'index', 'action'=>'edit', 'id'=>$data['id']));
    		
    	}
    	
    }
    
    
    public function newPerguntaAction(){
    	
    	if($this->request->isPost()){
    	
    		$form_pergunta = new FormPergunta();
    		$data = $this->request->getPost()->toArray();
    		$form_pergunta->setData($data);
    	
    		if($form_pergunta->isValid()){
    			 
    			$service = $this->getServiceLocator()->get("Enquete\Service\Pergunta");
    			if($service->insert($data)){
    				$this->flashmessenger()
    				->setNamespace("success")
    				->addMessage("Registro Inserido com sucesso");
    	
    			}else{
    	
    				$this->flashmessenger()
    				->setNamespace("error")
    				->addMessage("Erro de validação");
    			}
    			 
    		}else{
    			 
    			$this->flashmessenger()
    			->setNamespace("error")
    			->addMessage("Erro de validação");
    		}
    	
    		$this->redirect()->toRoute("admin/default", array("controller"=>'index', 'action'=>'edit', 'id'=>$data['Enquetes_id']));
    	
    	}
    	
    	
    }
    
    public function newRespostaAction(){
    	 
    	if($this->request->isPost()){
    		 
    		$form_resposta = new FormResposta();
    		$data = $this->request->getPost()->toArray();
    		$id_enquete = $data['id_enquete'];
    		unset($data['id_enquete']);
    		$form_resposta->setData($data);
    		 
    		if($form_resposta->isValid()){
    
    			$service = $this->getServiceLocator()->get("Enquete\Service\Resposta");
    			if($service->insert($data)){
    				$this->flashmessenger()
    				->setNamespace("success")
    				->addMessage("Registro Inserido com sucesso");
    				 
    			}else{
    				 
    				$this->flashmessenger()
    				->setNamespace("error")
    				->addMessage("Erro de validação");
    			}
    
    		}else{
    
    			$this->flashmessenger()
    			->setNamespace("error")
    			->addMessage("Erro de validação");
    		}
    		 
    		$this->redirect()->toRoute("admin/default", array("controller"=>'index', 'action'=>'edit', 'id'=>$id_enquete));
    		 
    	}
    	 
    	 
    }
    
    
    public function editPerguntaAction(){
    	
    	$form_pergunta = new FormPergunta();
    	$data = $this->request->getPost()->toArray();
    	$form_pergunta->setData($data);
    	 
    	if($form_pergunta->isValid()){
    	
    		$service = $this->getServiceLocator()->get("Enquete\Service\Pergunta");
    		if($service->update($data)){
    			$this->flashmessenger()
    			->setNamespace("success")
    			->addMessage("Registro Inserido com sucesso");
    			 
    		}else{
    			 
    			$this->flashmessenger()
    			->setNamespace("error")
    			->addMessage("Erro de validação");
    		}
    	
    	}else{
    	
    		$this->flashmessenger()
    		->setNamespace("error")
    		->addMessage("Erro de validação");
    	}
    	 
    	$this->redirect()->toRoute("admin/default", array("controller"=>'index', 'action'=>'edit', 'id'=>$data['Enquetes_id']));
    	 
    }
    
    
    public function editRespostaAction(){
    	
    	if($this->request->isPost()){
    	
    		$form_reposta = new FormResposta();
    		$data = $this->request->getPost()->toArray();
    		$id_enquete = $data['id_enquete'];
    		unset($data['id_enquete']);
    		$form_reposta->setData($data);
    	
    		if($form_reposta->isValid()){
    			 
    			$service = $this->getServiceLocator()->get("Enquete\Service\Resposta");
    			if($service->update($data)){
    				$this->flashmessenger()
    				->setNamespace("success")
    				->addMessage("Registro alterado com sucesso");
    	
    			}else{
    	
    				$this->flashmessenger()
    				->setNamespace("error")
    				->addMessage("Erro de validação");
    			}
    			 
    		}else{
    			 
    			$this->flashmessenger()
    			->setNamespace("error")
    			->addMessage("Erro de validação");
    		}
    	
    		$this->redirect()->toRoute("admin/default", array("controller"=>'index', 'action'=>'edit', 'id'=>$id_enquete));
    	
    	}
    	
    }
    	
    
    public function deletePerguntaAction(){
    	
    	if($this->request->isPost()){
    		 
    		
    		$data = $this->request->getPost()->toArray();
    		
    		
    		 $service = $this->getServiceLocator()->get("Enquete\Service\Pergunta");
    		 if($service->delete($data['id_pergunta'])){
    		 	
    		 	$this->flashmessenger()
    		 	->setNamespace("success")
    		 	->addMessage("Registro Removido com sucesso");
    		 }
    		
    		 
    		$this->redirect()->toRoute("admin/default", array("controller"=>'index', 'action'=>'edit', 'id'=>$data['id_enquete']));
    		 
    	}
    	
    }
    
    public function deleteRespostaAction(){
    	 
    	if($this->request->isPost()){
    		 
    
    		$data = $this->request->getPost()->toArray();
    		
    
    
    		$service = $this->getServiceLocator()->get("Enquete\Service\Resposta");
    		if($service->delete($data['id_resposta'])){
    
    			$this->flashmessenger()
    			->setNamespace("success")
    			->addMessage("Registro Removido com sucesso");
    		}
    
    		 
    		$this->redirect()->toRoute("admin/default", array("controller"=>'index', 'action'=>'edit', 'id'=>$data['id_enquete']));
    		 
    	}
    	 
    }
    
    
    
    
    
    public function relatorioAction(){
    	
    	$form = $this->getServiceLocator()->get("Enquete\Form\Relatorio");
    	
    	$enquete = false;
    	
    	if($this->request->isPost()){
    		
    		$data = $this->request->getPost()->toArray();
    		$form->setData($data);
    		
    		if($form->isValid()){
    			
    			$service = $this->getServiceLocator()->get("Enquete\Service\Enquete");
    			$enquete = $service->relatorio($data['enquete']);
    			
    			
    		}
    		
    		
    	}
    	
    	
    	
    	return new ViewModel(array("form"=>$form, "enquete"=>$enquete));
    	
    }
    
    
    
    
    
    
    
    
    
    
    
    public function convert(array $data){
    	
    	if(isset($data['perguntas'])){
    		
    		if(isset($data['respostas'])){
    			 
    			$array = array();
    			$n = 0;
    			foreach ($data['hide_perguntas'] as $key => $value){
    				$array[$n]['pergunta'] = $data['perguntas'][$n];
    				$repostas = array();
    		
    				foreach ($data['hide_respostas'] as $key2 => $value2){
    					 
    					if($value == $value2){
    		
    						array_push($repostas, $data['respostas'][$key2]);
    					}
    				}
    				if(count($repostas)>0){
    					$array[$n]['respostas'] = $repostas;
    				}
    					
    				$n++;
    			}
    			 
    		}else{
    			$n = 0;
    			foreach ($data['perguntas'] as $key=> $value){
    				$array[$n]['pergunta'] = $value;
    				$n++;
    			}
    		}
    		
    	}
	    	
    	
    	$array['titulo'] = $data['titulo'];
    	
    	return $array;
    	
    }
}
