<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Auth\Form\PasswordForm;

class PasswordFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Pacificnm\Auth\Form\PasswordForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new PasswordForm();
    }
}

