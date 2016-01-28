<?php

namespace Enquete\Form;

use Zend\Form\Form;

Class Resposta extends Form {
	
	public function __construct($name =null){
		
		parent::__construct('resposta');
		$this->setAttribute("method", 'post');
		$this->setInputFilter(new RespostaFilter());
		
		$this->add(array(
				
			'name'=> 'id',
			'attributes'=>array(
				'type'=>'hidden'
			)		
		));
		
		$this->add(array(
		
				'name'=> 'resposta',
				'options'=>array(
					'type'=> 'text',	
					'label'=>'Resposta',	
				),
				
				'attributes'=>array(
						'id'=> 'resposta',
						'placeholder'=>'Resposta',
						'class'=> 'form-control',
						
				)
		));
		
		$this->add(array(
		
				'name'=> 'Perguntas_id',
				'attributes'=>array(
						'type'=>'hidden'
				)
		));
		
		$this->add(array(
		
				'name'=> 'submit',
				'type'=> 'Submit',
				'attributes'=> array(
					'value'=>'Enviar',
					'class'=>' btn btn-primary'		
				)
		));
		
	}
	
}