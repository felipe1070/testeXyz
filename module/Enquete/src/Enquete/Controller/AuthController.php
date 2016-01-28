<?php

namespace Enquete\Controller;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
	Zend\Authentication\Storage\Session as SessionStorage;

use Enquete\Form\Login as LoginForm;

Class AuthController extends AbstractActionController{
	
	
	public function indexAction()
	{
		$form = new LoginForm;
		$error = false;
	
		$request = $this->getRequest();
	
		if($request->isPost())
		{
			
			$form->setData($request->getPost());
			if($form->isValid())
			{
				$data = $request->getPost()->toArray();
	
				// Criando Storage para gravar sessão da authtenticação
				$sessionStorage = new SessionStorage("auth_enquete");
	
				$auth = new AuthenticationService;
				$auth->setStorage($sessionStorage); // Definindo o SessionStorage para a auth
	
				$authAdapter = $this->getServiceLocator()->get("Enquete\Auth\Adapter");
				$authAdapter->setUsername($data['email']);
				$authAdapter->setPassword($data['password']);
	
				$result = $auth->authenticate($authAdapter);
			
				if($result->isValid())
				{
	
					$user = $auth->getIdentity();
					$user = $user['user'];
					$sessionStorage->write($user,null);
	
	
					
					return $this->redirect()->toRoute('admin');
                }
							else
									$error = true;
			}
		}
		
		
			$viewModel = new  ViewModel(array('form'=>$form,'error'=>$error));
			$viewModel->setTerminal(true);
			return $viewModel;
		
					
	}
	
	public function logoutAction(){
	
		$auth = new AuthenticationService;
		$auth->setStorage(new SessionStorage("auth_enquete"));
		$auth->clearIdentity();
		$this->redirect()->toRoute("auth");
	
	
	}
	
	
}