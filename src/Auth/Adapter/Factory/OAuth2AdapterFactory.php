<?php
namespace Auth\Adapter\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Adapter\Driver\Pdo\Pdo as PdoDriver;
use Auth\Adapter\OAuth2Adapter;

class OAuth2AdapterFactory
{

    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
     
        $connection = $serviceLocator->get('db1');
        
        if (! $connection->getDriver() instanceof PdoDriver) {
            throw new \RuntimeException("Need a PDO connection!");
        }
        
        
        $pdo = $connection->getDriver()
            ->getConnection()
            ->getResource();
            
        
            
        return new OAuth2Adapter($pdo);
    }
}
