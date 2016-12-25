<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\SignInController;
use Auth\Form\SignInForm;

class SignInControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\Controller\SignInController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $authService = $realServiceLocator->get('Zend\Authentication\AuthenticationService');
        
        $authAdapter = $realServiceLocator->get('Auth\Adapter\AuthAdapter');
        
        $signInForm = new SignInForm();
        
        $service = $realServiceLocator->get('Auth\Service\ServiceInterface');
        
        return new SignInController($authService, $authAdapter, $service, $signInForm);
    }
}
