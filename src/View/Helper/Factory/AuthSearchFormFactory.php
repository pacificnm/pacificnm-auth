<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Auth\View\Helper\AuthSearchForm;

class AuthSearchFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Auth\View\Helper\AuthSearchForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $aclRoleService = $realServiceLocator->get('Pacificnm\AclRole\Service\ServiceInterface');
        
        return new AuthSearchForm($aclRoleService);
    }
}

