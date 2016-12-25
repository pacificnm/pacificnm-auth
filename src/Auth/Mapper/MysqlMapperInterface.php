<?php
namespace Auth\Mapper;

use Auth\Entity\Entity;
use Zend\Paginator\Paginator;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return Paginator
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return Entity
     */
    public function get($id);

    /**
     *
     * @param string $authEmail            
     * @param string $authPassword            
     */
    public function getAuth($authEmail, $authPassword);

    /**
     *
     * @param string $authEmail            
     * @return Entity
     */
    public function getAuthByEmail($authEmail);

    /**
     *
     * @param Entity $entity            
     * @return Entity
     */
    public function save(Entity $entity);

    /**
     *
     * @param Entity $entity            
     * @return boolean
     */
    public function delete(Entity $entity);
}