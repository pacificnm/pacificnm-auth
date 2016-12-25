<?php
namespace Auth\Adapter\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Adapter\AuthAdapter;

class AuthAdapterFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Auth\Adapter\AuthAdapter
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->get('Auth\Service\ServiceInterface');
        
        return new AuthAdapter($service);
    }
}
