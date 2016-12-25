<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\ResetPasswordController;

class ResetPasswordControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\Controller\ResetPasswordController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
    
        $service = $realServiceLocator->get('Auth\Service\ServiceInterface');
        
        $configService = $realServiceLocator->get('Config\Service\ServiceInterface');
        
        $form = $realServiceLocator->get('Auth\Form\ResetForm');
        
        return new ResetPasswordController($service, $configService, $form);
    }
}

