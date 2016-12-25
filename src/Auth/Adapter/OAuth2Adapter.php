<?php
namespace Auth\Adapter;

use ZF\OAuth2\Adapter\PdoAdapter;
use Zend\Db\Sql\Sql;

class OAuth2Adapter extends PdoAdapter
{

    /**
     *
     * @param unknown $connection            
     * @param array $config            
     */
    public function __construct($connection, $config = array())
    {
        // \Zend\Debug\Debug::dump($connection); die;
        $config = [
            'user_table' => 'auth'
        ];
        
        return parent::__construct($connection, $config);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \OAuth2\Storage\Pdo::getUser()
     */
    public function getUser($username)
    {
        $sql = sprintf('SELECT * from %s where auth_email=:username', $this->config['user_table']);
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute(array(
            'username' => $username
        ));
        
        if (! $userInfo = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return false;
        }
        
        // the default behavior is to use "username" as the user_id we use the auth_id
        $arr = array_merge(array(
            'user_id' => $userInfo['auth_id'],
        ), $userInfo);
        
        return $arr;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ZF\OAuth2\Adapter\PdoAdapter::setUser()
     */
    public function setUser($username, $password, $firstName = null, $lastName = null)
    {
       
        // do not store in plaintext, use bcrypt
        $this->createBcryptHash($password);
        
        // if it exists, update it.
        if ($this->getUser($username)) {
            $sql = sprintf('UPDATE %s SET pwd=:password, firstname=:firstName,
                    surname=:lastName WHERE username=:username', $this->config['user_table']);
            $stmt = $this->db->prepare($sql);
        } else {
            $sql = sprintf('INSERT INTO %s (auth_email, auth_password, firstname, surname)
                    VALUES (:username, :password, :firstName, :lastName)', $this->config['user_table']);
            $stmt = $this->db->prepare($sql);
        }
        
        return $stmt->execute(compact('username', 'password', 'firstName', 'lastName'));
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ZF\OAuth2\Adapter\PdoAdapter::checkPassword()
     */
    protected function checkPassword($user, $password)
    {
        return $this->verifyHash($password, $user['auth_password']);
    }
}

?>