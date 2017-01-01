<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Auth\Service\Service;

class ServiceFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Auth\Service\Service
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Pacificnm\Auth\Mapper\MysqlMapperInterface');
        
        return new Service($mapper);
    }
}