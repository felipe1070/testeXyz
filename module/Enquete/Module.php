<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Enquete;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Enquete\Form\Relatorio as FormRelatorio;
use Enquete\Auth\Adapter as AuthAdapter;

use Zend\ModuleManager\ModuleManager;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function init(ModuleManager $moduleManager){
    	
    	$sharedEvents = $moduleManager->getEventManager()->getSharedManager();
    	$sharedEvents->attach("Enquete", "dispatch", function($e){
    
    		$auth = new AuthenticationService;
    		$auth->setStorage(new SessionStorage('auth_enquete'));
    
    		$controller = $e->getTarget();
    		$matchedRout = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
    
    		if(!$auth->hasIdentity() and ($matchedRout =="admin" or $matchedRout == "admin/default")){
    			 
    			return $controller->redirect()->toRoute("auth");
    			 
    		}
    
    	},99);
    		 
    		 
    }
    
    public function getServiceConfig()
    {
    
    	return array(
    			'factories' => array(    					
    					
    						
    					'Enquete\Service\Insert' => function($sm){
    
    						return new Service\Insert($sm->get("Doctrine\ORM\EntityManager"));
    					}, 
    					
    					'Enquete\Service\Enquete' => function($sm){
    					
    						return new Service\Enquete($sm->get("Doctrine\ORM\EntityManager"));
    					},
    					
    					'Enquete\Service\Pergunta' => function($sm){
    							
    						return new Service\Pergunta($sm->get("Doctrine\ORM\EntityManager"));
    					},
    					
    					'Enquete\Service\Resposta' => function($sm){
    							
    						return new Service\Resposta($sm->get("Doctrine\ORM\EntityManager"));
    					},
    					
    					'Enquete\Form\Relatorio' => function($sm) {
    						$em = $sm->get('Doctrine\ORM\EntityManager');
    						$repository = $em->getRepository("Enquete\Entity\Enquetes");
    						$enquetes = $repository->fetchPairs();
    							
    						return new FormRelatorio(null, $enquetes);
    					
    					
    					},
    					'Enquete\Auth\Adapter' => function($sm){
    					
    						return new AuthAdapter($sm->get("Doctrine\ORM\EntityManager"));
    					}
    						
    
    			)
    	);
    
    }
}
