<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\RegisterController;
use Auth\Form\RegisterForm;

class RegisterControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\Controller\RegisterController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();

        $service = $realServiceLocator->get('Auth\Service\ServiceInterface');
        
        $form = new RegisterForm();
        
        return new RegisterController($service, $form);
    }
}

