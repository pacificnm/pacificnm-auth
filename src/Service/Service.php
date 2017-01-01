<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Service;

use Pacificnm\Auth\Mapper\MysqlMapperInterface;
use Pacificnm\Auth\Entity\Entity;

class Service implements ServiceInterface
{

    /**
     *
     * @var AuthMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param AuthMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Service\ServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Service\ServiceInterface::getAuth()
     */
    public function getAuth($authEmail, $entity)
    {
        return $this->mapper->getAuth($authEmail, $entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Service\ServiceInterface::getAuthByEmail()
     */
    public function getAuthByEmail($authEmail)
    {
        return $this->mapper->getAuthByEmail($authEmail);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Service\ServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Service\ServiceInterface::save()
     */
    public function save(Entity $authEntity)
    {
        return $this->mapper->save($authEntity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Auth\Service\ServiceInterface::delete()
     */
    public function delete(Entity $authEntity)
    {
        return $this->mapper->delete($authEntity);
    }
}
