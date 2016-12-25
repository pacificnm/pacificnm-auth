<?php
namespace Auth\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Service\Service;

class ServiceFactory
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Auth\Mapper\MysqlMapperInterface');
        
        return new Service($mapper);
    }
}