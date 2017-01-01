<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth;

class Module
{
    public function getConsoleUsage()
    {
        return array(
            'auth --list' => 'lists all Auth',
            'auth --view [--id=]' => 'gets a single Auth by its id'
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/pacificnm.auth.global.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/',
                ),
            ),
        );
    }
}
