<?php
namespace Auth\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Form\ProfileForm;

class ProfileFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Auth\Form\ProfileForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new ProfileForm();
    }
}

