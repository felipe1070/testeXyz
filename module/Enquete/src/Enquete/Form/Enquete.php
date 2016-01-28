<?php

namespace Enquete\Form;

use Zend\Form\Form;

Class Enquete extends Form {
	
	public function __construct($name =null){
		
		parent::__construct('enquete');
		$this->setAttribute("method", 'post');
		$this->setInputFilter(new EnqueteFilter());
		
		$this->add(array(
				
			'name'=> 'id',
			'attributes'=>array(
				'type'=>'hidden'
			)		
		));
		
		$this->add(array(
		
				'name'=> 'titulo',
				'options'=>array(
					'type'=> 'text',	
					'label'=>'Titulo',	
				),
				
				'attributes'=>array(
						'id'=> 'titulo',
						'placeholder'=>'Título',
						'class'=> 'form-control',
						
				)
		));
		
		$this->add(array(
		
				'name'=> 'submit',
				'type'=> 'Submit',
				'attributes'=> array(
					'value'=>'Salvar',
					'class'=>' btn btn-primary'		
				)
		));
		
	}
	
}