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
use Pacificnm\Auth\Controller\ResetPasswordController;

class ResetPasswordControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Auth\Controller\ResetPasswordController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
    
        $service = $realServiceLocator->get('Pacificnm\Auth\Service\ServiceInterface');
        
        $configService = $realServiceLocator->get('Pacificnm\Config\Service\ServiceInterface');
        
        $form = $realServiceLocator->get('Pacificnm\Auth\Form\ResetForm');
        
        return new ResetPasswordController($service, $configService, $form);
    }
}

