<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\UpdateController;
use Auth\Form\Form;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Auth\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Auth\Service\ServiceInterface');
       
        $form = $realServiceLocator->get('Auth\Form\Form');
        
        $profileForm = $realServiceLocator->get('Auth\Form\ProfileForm');
        
        return new UpdateController($service, $form, $profileForm);
    }
}