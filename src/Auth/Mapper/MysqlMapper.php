<?php
namespace Auth\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Application\Mapper\AbstractMysqlMapper;
use Auth\Entity\Entity;
use Zend\Hydrator\HydratorInterface;

class MysqlMapper extends AbstractMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param Entity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, Entity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinAclRole();
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::getAuth()
     */
    public function getAuth($authEmail, $authPassword)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinAclRole();
        
        $this->select->where(array(
            'auth.auth_email = ?' => $authEmail
        ));
        
        $this->select->where(array(
            'auth.auth_password = ?' => $authPassword
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::getAuthByEmail()
     */
    public function getAuthByEmail($authEmail)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinAclRole();
        
        $this->select->where(array(
            'auth.auth_email = ?' => $authEmail
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('auth');
        
        $this->joinAclRole();
        
        $this->select->where(array(
            'auth.auth_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::save()
     */
    public function save(Entity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getAuthId()) {
            $this->update = new Update('auth');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'auth.auth_id = ?' => $entity->getAuthId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('auth');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setAuthId($id);
        }
        
        return $this->get($entity->getAuthId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(Entity $entity)
    {
        $this->delete = new Delete('auth');
        
        $this->delete->where(array(
            'auth.auth_id = ?' => $entity->getAuthId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \Auth\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
    
    /**
     * 
     * @return \Auth\Mapper\MysqlMapper
     */
    protected function joinAclRole()
    {
        $this->select->join('acl_role', 'auth.acl_role_id = acl_role.acl_role_id', array(
            'acl_role_name'
        ), 'inner');
        
        return $this;
    }
}
