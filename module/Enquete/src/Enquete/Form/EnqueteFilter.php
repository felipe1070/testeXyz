<?php

namespace Enquete\Form;

use Zend\InputFilter\InputFilter;

Class EnqueteFilter extends InputFilter{
	
	
	public function __construct(){
		
		$this->add(array(
			'name' => 'titulo',
			'required' => true,
			'filters' => array(
				array('name'=> 'StripTags'),
				array('name'=> 'StringTrim')
			),
			'validators' => array(
					
				array(
						'name' => 'NotEmpty',
						'options' => array(
								'messages'=> array('isEmpty'=>'Nome não pode estar em branco')
						)
						
				)	
					
			)			
				
		));
		
	}
	
}