<?php
namespace Auth\Form\Factory;


use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Form\Form;

class CreateFormFactory
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\Form\Form
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $roleService = $serviceLocator->get('AclRole\Service\ServiceInterface');
    
        return new Form($roleService, true);
    }
}

