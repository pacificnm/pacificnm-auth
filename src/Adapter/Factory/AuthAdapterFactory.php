<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Adapter\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Auth\Adapter\AuthAdapter;

class AuthAdapterFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Auth\Adapter\AuthAdapter
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->get('Pacificnm\Auth\Service\ServiceInterface');
        
        return new AuthAdapter($service);
    }
}
