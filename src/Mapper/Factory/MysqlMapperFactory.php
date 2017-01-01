<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Mapper\Factory;

use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Auth\Mapper\MysqlMapper;
use Pacificnm\Auth\Hydrator\Hydrator;
use Pacificnm\Auth\Entity\Entity;

class MysqlMapperFactory 
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Auth\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new Hydrator());
        
        $prototype = new Entity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}