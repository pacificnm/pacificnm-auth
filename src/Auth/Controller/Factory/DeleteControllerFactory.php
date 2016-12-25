<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Auth\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Auth\Service\ServiceInterface');
        
        return new DeleteController($service);
    }
}
