<?php
namespace Auth\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Form\ResetForm;

class ResetFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Auth\Form\ResetForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->get('Auth\Service\ServiceInterface');
         
        return new ResetForm($service);
    }
}

