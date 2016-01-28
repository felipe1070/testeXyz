<?php

namespace Enquete\Form;

use Zend\Form\Form,
	Zend\Form\Element\Select;


Class Relatorio extends Form {
	
	
	protected $enquetes;
	
	public function __construct($name =null, array $enquetes){
		
		parent::__construct('relatorio');
		$this->setAttribute("method", 'post');
		
		$this->enquetes = $enquetes;
	
		
		
		
		$enquete = new Select();
		$enquete->setLabel("Enquetes")
				  ->setName("enquete")
				  ->setOptions(array('value_options'=>$this->enquetes))
				  ->setAttribute("required", true)
				  ->setAttribute("Class", "form-control");
		$this->add($enquete);
		
		
		
		
		
		$this->add(array(
		
				'name'=> 'submit',
				'type'=> 'Submit',
				'attributes'=> array(
					'value'=>'Enviar',
					'class'=>' btn-primary btn'		
				)
		));
		
	}
	
}