<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Pacificnm\Auth\Service\ServiceInterface;

class AuthAdapter implements AdapterInterface
{

    /**
     *
     * @var string
     */
    protected $authEmail;

    /**
     *
     * @var string
     */
    protected $authPassword;

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     * 
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Authentication\Adapter\AdapterInterface::authenticate()
     */
    public function authenticate()
    {
        $bcrypt = new Bcrypt();
        
        $authEntity = $this->service->getAuthByEmail($this->authEmail);
        
        if (! $authEntity) {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, 'Invalid Username / Password combination.', array());
        }
        
        if ($bcrypt->verify($this->authPassword, $authEntity->getAuthPassword())) {
            return new Result(Result::SUCCESS, $authEntity);
        }
        
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, 'Invalid Username / Password combination.', array());
    }

    /**
     *
     * @param string $authEmail            
     */
    public function setIdentity($authEmail)
    {
        $this->authEmail = $authEmail;
    }

    /**
     *
     * @param string $authPassword            
     */
    public function setCredential($authPassword)
    {
        $this->authPassword = $authPassword;
    }

    /**
     *
     * @param string $type            
     * @param string $identity            
     * @param string $message            
     */
    protected function getResult($type, $identity, $message)
    {
        return new Result($type, $identity, array(
            $message
        ));
    }
}