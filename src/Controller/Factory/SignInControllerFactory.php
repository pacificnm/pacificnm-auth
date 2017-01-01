<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Auth\Controller\SignInController;
use Pacificnm\Auth\Form\SignInForm;

class SignInControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Auth\Controller\SignInController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $authService = $realServiceLocator->get('Zend\Authentication\AuthenticationService');
        
        $authAdapter = $realServiceLocator->get('Pacificnm\Auth\Adapter\AuthAdapter');
        
        $signInForm = new SignInForm();
        
        $service = $realServiceLocator->get('Pacificnm\Auth\Service\ServiceInterface');
        
        return new SignInController($authService, $authAdapter, $service, $signInForm);
    }
}
