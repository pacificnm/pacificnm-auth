<?php
namespace Auth\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Form\PasswordForm;

class PasswordFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Auth\Form\PasswordForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new PasswordForm();
    }
}

