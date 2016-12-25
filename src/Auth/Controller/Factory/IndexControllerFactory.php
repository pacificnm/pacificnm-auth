<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\IndexController;

class IndexControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Auth\Service\ServiceInterface');
        
        return new IndexController($service);
    }
}