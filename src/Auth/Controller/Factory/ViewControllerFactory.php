<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Auth\Service\ServiceInterface');
        
        return new ViewController($service);
    }
}
