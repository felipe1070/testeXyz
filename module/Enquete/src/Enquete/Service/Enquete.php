<?php
 namespace Enquete\Service;
 
 use Doctrine\ORM\EntityManager;



	 
Class Enquete extends AbstractService{
 	
 	
 	
	function __construct(EntityManager $em){
		
		parent::__construct($em);
		$this->entity = "Enquete\Entity\Enquetes";
		
	}
 	
	
	public function delete($id){
		
		$repo = $this->em->getRepository($this->entity);
		
		$result = $repo->find($id);
		
		if($result){
			
			foreach ($result->getPerguntas() as $value){
				foreach ($value->getRespostas() as $value2){
					$entity = $this->em->getReference("Enquete\Entity\Respostas", $value2->getId());
					$this->em->remove($entity);
				}
				
				$this->em->remove($value);
			}
			
			$this->em->remove($result);
			$this->em->flush();
			return $id;
		}
		
	}
	
	
	
	
	public function relatorio($id){
		
		$repo = $this->em->getRepository($this->entity);
		$enquete = $repo->find($id);
		
		$array = array();
		$array['titulo'] = $enquete->getTitulo();
		
		$array['perguntas'] = array();
		
		$n = 0;
		
		foreach ($enquete->getPerguntas() as $key =>$value){
			
			$novo = array(
					'pergunta'=> $value->getPergunta(),
					'qtd_resp' => count($value->getRespostas()),
					'respostas' => $value->getRespostas()
			);
			
			$numero =0;
			foreach ($value->getRespostas() as $key2=>$value2){
				$numero += $value2->getNumero();
			}
			$novo['qtd_voto'] = $numero;
			
			$array['perguntas'][$n] = $novo;
			$n++;
		}
		
		return $array;
		
		
	}
 	
 	
 	
 	
 	
 	
 	
 	
 	
 }