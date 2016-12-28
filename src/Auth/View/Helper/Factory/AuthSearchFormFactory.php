<?php
namespace Auth\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\View\Helper\AuthSearchForm;

class AuthSearchFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\View\Helper\AuthSearchForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $aclRoleService = $realServiceLocator->get('AclRole\Service\ServiceInterface');
        
        return new AuthSearchForm($aclRoleService);
    }
}

