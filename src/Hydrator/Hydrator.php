<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Hydrator;

use Pacificnm\Auth\Entity\Entity;
use Zend\Hydrator\ClassMethods;

class Hydrator extends ClassMethods
{

    /**
     *
     * @param string $underscoreSeparatedKeys            
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof Entity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $aclRoleEntity = parent::hydrate($data, new \Pacificnm\AclRole\Entity\Entity());
        
        $object->setAclRoleEntity($aclRoleEntity);
        
        return $object;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof Entity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['access_token']);
        
        unset($data['refresh_token']);
        
        unset($data['expires_in']);
        
        unset($data['acl_role_entity']);
        
        return $data;
    }
}