<?php

namespace Enquete\Form;

use Zend\Form\Form;

Class Pergunta extends Form {
	
	public function __construct($name =null){
		
		parent::__construct('pergunta');
		$this->setAttribute("method", 'post');
		$this->setInputFilter(new PerguntaFilter());
		
		$this->add(array(
				
			'name'=> 'id',
			'attributes'=>array(
				'type'=>'hidden'
			)		
		));
		
		$this->add(array(
		
				'name'=> 'pergunta',
				'options'=>array(
					'type'=> 'text',	
					'label'=>'Pergunta',	
				),
				
				'attributes'=>array(
						'id'=> 'pergunta',
						'placeholder'=>'Pergunta',
						'class'=> 'form-control',
						
				)
		));
		
		$this->add(array(
		
				'name'=> 'Enquetes_id',
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