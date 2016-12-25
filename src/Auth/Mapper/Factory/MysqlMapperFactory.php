<?php
namespace Auth\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Mapper\MysqlMapper;
use Zend\Hydrator\Aggregate\AggregateHydrator;
use Auth\Hydrator\Hydrator;
use Auth\Entity\Entity;

class MysqlMapperFactory 
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\Mapper\MysqlMapper
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