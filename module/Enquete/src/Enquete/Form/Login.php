<?php

namespace Enquete\Form;

use Zend\Form\Form;

class Login  extends Form
{

    public function __construct($name = null, $options = array()) {
        parent::__construct('login', $options);
        
       
        $this->setAttribute('method', 'post');
       
        $email = new \Zend\Form\Element\Text("email");
        $email->setAttribute('placeholder','Entre com o Email')
                ->setAttribute("Class", "form-control uname");
        $this->add($email);
       
        $password = new \Zend\Form\Element\Password("password");
        $password->setAttribute('placeholder','Entre com a senha')
        		->setAttribute("Class", "form-control pword");
        $this->add($password);
        
        $this->add(array(
            'name' => 'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes' => array(
                'value'=>'Login',
                'class' => 'btn btn-success btn-block'
            )
        ));
                
       
    }
    
}
