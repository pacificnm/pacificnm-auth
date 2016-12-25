<?php
namespace Auth\Entity;

use AclRole\Entity\Entity as AclRoleEntity;

class Entity
{

    /**
     *
     * @var number
     */
    protected $authId;

    /**
     *
     * @var number
     */
    protected $aclRoleId;

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
     * @var string
     */
    protected $authName;

    /**
     *
     * @var string
     */
    protected $authLastLogin;

    /**
     *
     * @var string
     */
    protected $authLastIp;

    /**
     *
     * @var string
     */
    protected $accessToken;

    /**
     *
     * @var string
     */
    protected $refreshToken;

    /**
     *
     * @var number
     */
    protected $expiresIn;

    /**
     *
     * @var AclRoleEntity
     */
    protected $aclRoleEntity;

    /**
     *
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     *
     * @return the $aclRoleId
     */
    public function getAclRoleId()
    {
        return $this->aclRoleId;
    }

    /**
     *
     * @return the $authEmail
     */
    public function getAuthEmail()
    {
        return $this->authEmail;
    }

    /**
     *
     * @return the $authPassword
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     *
     * @return the $authName
     */
    public function getAuthName()
    {
        return $this->authName;
    }

    /**
     *
     * @return the $authLastLogin
     */
    public function getAuthLastLogin()
    {
        return $this->authLastLogin;
    }

    /**
     *
     * @return the $authLastIp
     */
    public function getAuthLastIp()
    {
        return $this->authLastIp;
    }

    /**
     *
     * @return the $accessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     *
     * @return the $refreshToken
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     *
     * @return the $expiresIn
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     *
     * @return the $aclRoleEntity
     */
    public function getAclRoleEntity()
    {
        return $this->aclRoleEntity;
    }

    /**
     *
     * @param number $authId            
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     *
     * @param number $aclRoleId            
     */
    public function setAclRoleId($aclRoleId)
    {
        $this->aclRoleId = $aclRoleId;
    }

    /**
     *
     * @param string $authEmail            
     */
    public function setAuthEmail($authEmail)
    {
        $this->authEmail = $authEmail;
    }

    /**
     *
     * @param string $authPassword            
     */
    public function setAuthPassword($authPassword)
    {
        $this->authPassword = $authPassword;
    }

    /**
     *
     * @param string $authName            
     */
    public function setAuthName($authName)
    {
        $this->authName = $authName;
    }

    /**
     *
     * @param string $authLastLogin            
     */
    public function setAuthLastLogin($authLastLogin)
    {
        $this->authLastLogin = $authLastLogin;
    }

    /**
     *
     * @param string $authLastIp            
     */
    public function setAuthLastIp($authLastIp)
    {
        $this->authLastIp = $authLastIp;
    }

    /**
     *
     * @param string $accessToken            
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     *
     * @param string $refreshToken            
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     *
     * @param number $expiresIn            
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     *
     * @param \AclRole\Entity\Entity $aclRoleEntity            
     */
    public function setAclRoleEntity($aclRoleEntity)
    {
        $this->aclRoleEntity = $aclRoleEntity;
    }
}
