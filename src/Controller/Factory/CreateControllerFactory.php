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
use Pacificnm\Auth\Controller\CreateController;
use Pacificnm\Auth\Form\Form;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Pacificnm\Auth\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Pacificnm\Auth\Service\ServiceInterface');
        
        $form = $realServiceLocator->get('Pacificnm\Auth\Form\CreateForm');
        
        return new CreateController($service, $form);
    }
}