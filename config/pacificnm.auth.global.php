<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
return array(
    'module' => array(
        'Auth' => array(
            'name' => 'Auth',
            'version' => '1.0.6',
            'install' => array(
                'require' => array(),
                'sql' => 'sql/auth.sql'
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Pacificnm\Auth\Controller\SignInController' => 'Pacificnm\Auth\Controller\Factory\SignInControllerFactory',
            'Pacificnm\Auth\Controller\SignOutController' => 'Pacificnm\Auth\Controller\Factory\SignOutControllerFactory',
            'Pacificnm\Auth\Controller\IndexController' => 'Pacificnm\Auth\Controller\Factory\IndexControllerFactory',
            'Pacificnm\Auth\Controller\CreateController' => 'Pacificnm\Auth\Controller\Factory\CreateControllerFactory',
            'Pacificnm\Auth\Controller\DeleteController' => 'Pacificnm\Auth\Controller\Factory\DeleteControllerFactory',
            'Pacificnm\Auth\Controller\UpdateController' => 'Pacificnm\Auth\Controller\Factory\UpdateControllerFactory',
            'Pacificnm\Auth\Controller\ViewController' => 'Pacificnm\Auth\Controller\Factory\ViewControllerFactory',
            'Pacificnm\Auth\Controller\PasswordController' => 'Pacificnm\Auth\Controller\Factory\PasswordControllerFactory',
            'Pacificnm\Auth\Controller\ProfileController' => 'Pacificnm\Auth\Controller\Factory\ProfileControllerFactory',
            'Pacificnm\Auth\Controller\RegisterController' => 'Pacificnm\Auth\Controller\Factory\RegisterControllerFactory',
            'Pacificnm\Auth\Controller\ResetPasswordController' => 'Pacificnm\Auth\Controller\Factory\ResetPasswordControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Pacificnm\Auth\Adapter\AuthAdapter' => 'Pacificnm\Auth\Adapter\Factory\AuthAdapterFactory',
            'Pacificnm\Auth\Adapter\OAuth2Adapter' => 'Pacificnm\Auth\Adapter\Factory\OAuth2AdapterFactory',
            'Pacificnm\Auth\Mapper\MysqlMapperInterface' => 'Pacificnm\Auth\Mapper\Factory\MysqlMapperFactory',
            'Pacificnm\Auth\Service\ServiceInterface' => 'Pacificnm\Auth\Service\Factory\ServiceFactory',
            'Pacificnm\Auth\Form\PasswordForm' => 'Pacificnm\Auth\Form\Factory\PasswordFormFactory',
            'Pacificnm\Auth\Form\Form' => 'Pacificnm\Auth\Form\Factory\FormFactory',
            'Pacificnm\Auth\Form\CreateForm' => 'Pacificnm\Auth\Form\Factory\CreateFormFactory',
            'Pacificnm\Auth\Form\ResetForm' => 'Pacificnm\Auth\Form\Factory\ResetFormFactory',
            'Pacificnm\Auth\Form\ProfileForm' => 'Pacificnm\Auth\Form\Factory\ProfileFormFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'auth-profile-index' => array(
                'type' => 'literal',
                'pageTitle' => 'My Profile',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'auth-profile-index',
                'activeSubMenuItem' => 'auth-profile-index',
                'icon' => 'fa fa-user',
                'layout' => 'profile',
                'options' => array(
                    'route' => '/my-profile',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\ProfileController',
                        'action' => 'index'
                    )
                )
            ),
            'auth-profile-update' => array(
                'type' => 'literal',
                'pageTitle' => 'My Profile',
                'pageSubTitle' => 'Settings',
                'activeMenuItem' => 'auth-profile-index',
                'activeSubMenuItem' => 'auth-profile-update',
                'icon' => 'fa fa-user',
                'layout' => 'profile',
                'options' => array(
                    'route' => '/my-profile/update',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\UpdateController',
                        'action' => 'profile'
                    )
                )
            ),
            'auth-profile-password' => array(
                'type' => 'literal',
                'pageTitle' => 'My Profile',
                'pageSubTitle' => 'Password',
                'activeMenuItem' => 'auth-profile-index',
                'activeSubMenuItem' => 'auth-profile-password',
                'icon' => 'fa fa-user',
                'layout' => 'profile',
                'options' => array(
                    'route' => '/my-profile/password',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\PasswordController',
                        'action' => 'profile'
                    )
                )
            ),
            'auth-reset-password-index' => array(
                'type' => 'literal',
                'pageTitle' => 'Reset Password',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'auth-reset-password-index',
                'icon' => 'fa fa-user',
                'layout' => 'sign-in',
                'options' => array(
                    'route' => '/reset-password',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\ResetPasswordController',
                        'action' => 'index'
                    )
                )
            ),
            'auth-register-index' => array(
                'type' => 'literal',
                'pageTitle' => 'Register',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'auth-register-index',
                'activeSubMenuItem' => 'auth-register-index',
                'icon' => 'fa fa-user',
                'layout' => 'register',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\RegisterController',
                        'action' => 'index'
                    )
                )
            ),
            'auth-sign-in' => array(
                'pageTitle' => 'Sign In',
                'pageSubTitle' => '',
                'activeMenuItem' => '',
                'activeSubMenuItem' => '',
                'icon' => 'fa fa-lock',
                'layout' => 'sign-in',
                'type' => 'literal',
                'options' => array(
                    'route' => '/sign-in',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\SignInController',
                        'action' => 'index'
                    )
                )
            ),
            
            'auth-sign-out' => array(
                'pageTitle' => 'Sign Out',
                'pageSubTitle' => '',
                'activeMenuItem' => '',
                'activeSubMenuItem' => '',
                'icon' => 'fa fa-lock',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/sign-out',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\SignOutController',
                        'action' => 'index'
                    )
                )
            ),
            'auth-index' => array(
                'pageTitle' => 'Auth',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'auth-index',
                'icon' => 'fa fa-user',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/auth',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'auth-create' => array(
                'pageTitle' => 'Auth',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'auth-index',
                'icon' => 'fa fa-user',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/auth/create',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'auth-update' => array(
                'pageTitle' => 'Auth',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'auth-index',
                'icon' => 'fa fa-user',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/update/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\UpdateController',
                        'action' => 'index'
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                )
            ),
            'auth-view' => array(
                'pageTitle' => 'Auth',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'auth-index',
                'icon' => 'fa fa-user',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/view/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\ViewController',
                        'action' => 'index'
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                )
            ),
            'auth-delete' => array(
                'pageTitle' => 'Auth',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'auth-index',
                'icon' => 'fa fa-user',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/delete/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\DeleteController',
                        'action' => 'index'
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                )
            ),
            'auth-password' => array(
                'pageTitle' => 'Auth',
                'pageSubTitle' => 'Password',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'auth-index',
                'icon' => 'fa fa-user',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/password/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Auth\Controller\PasswordController',
                        'action' => 'index'
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+'
                    )
                )
            )
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            'AuthNavBar' => 'Pacificnm\Auth\View\Helper\AuthNavBar',
            'AuthAside' => 'Pacificnm\Auth\View\Helper\AuthAside'
        ),
        'factories' => array(
            'AuthSearchForm' => 'Pacificnm\Auth\View\Helper\Factory\AuthSearchFormFactory'
        )
    ),
    'view_manager' => array(
        'controller_map' => array(
            'Pacificnm\Auth' => true
        ),
        'template_map' => array(
            'pacificnm/auth/create/index' => __DIR__ . '/../view/auth/create/index.phtml',
            'pacificnm/auth/delete/index' => __DIR__ . '/../view/auth/delete/index.phtml',
            'pacificnm/auth/index/index' => __DIR__ . '/../view/auth/index/index.phtml',
            'pacificnm/auth/password/index' => __DIR__ . '/../view/auth/password/index.phtml',
            'pacificnm/auth/password/profile' => __DIR__ . '/../view/auth/password/profile.phtml',
            'pacificnm/auth/profile/index' => __DIR__ . '/../view/auth/profile/index.phtml',
            'pacificnm/auth/register/index' => __DIR__ . '/../view/auth/register/index.phtml',
            'pacificnm/auth/reset-password/index' => __DIR__ . '/../view/auth/reset-password/index.phtml',
            'pacificnm/auth/sign-in/index' => __DIR__ . '/../view/auth/sign-in/index.phtml',
            'pacificnm/auth/update/index' => __DIR__ . '/../view/auth/update/index.phtml',
            'pacificnm/auth/update/profile' => __DIR__ . '/../view/auth/update/profile.phtml',
            'pacificnm/auth/view/index' => __DIR__ . '/../view/auth/view/index.phtml'
        ),
        'template_path_stack' => array(
            'pacificnm-auth' => __DIR__ . '/../view'
        )
    ),
    'acl' => array(
        'default' => array(
            'guest' => array(
                'auth-sign-in',
                'auth-sign-out',
                'auth-register-index',
                'auth-reset-password-index'
            ),
            'user' => array(
                'auth-profile-index',
                'auth-profile-update',
                'auth-profile-password',
                'auth-sign-out',
                'auth-sign-in'
            ),
            'administrator' => array(
                'auth-index',
                'auth-create',
                'auth-delete',
                'auth-update',
                'auth-view',
                'auth-password',
                'auth-profile-index',
                'auth-profile-update',
                'auth-profile-password',
                'auth-sign-out',
                'auth-sign-in'
            )
        )
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'My Profile',
                'route' => 'auth-profile-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Edit',
                        'route' => 'auth-profile-update',
                        'useRouteMatch' => true,
                    ),
                    array(
                        'label' => 'Password',
                        'route' => 'auth-profile-password',
                        'useRouteMatch' => true,
                    )
                )
            ),
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Auth',
                        'route' => 'auth-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'auth-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'auth-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Update',
                                        'route' => 'auth-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'auth-delete',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Reset Password',
                                        'route' => 'auth-password',
                                        'useRouteMatch' => true
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    ),
    'menu' => array(
        'default' => array(
            array(
                'route' => 'auth-profile-index',
                'name' => 'My Profile',
                'icon' => 'fa fa-user',
                'order' => 1,
                'location' => 'left',
                'active' => true,
                'items' => array(
                    array(
                        'name' => 'Home',
                        'route' => 'auth-profile-index',
                        'icon' => 'fa fa-home',
                        'order' => 1,
                        'active' => true,
                    ),
                    array(
                        'name' => 'Settings',
                        'route' => 'auth-profile-update',
                        'icon' => 'fa fa-gear',
                        'order' => 2,
                        'active' => true,
                    ),
                    array(
                        'name' => 'Password',
                        'route' => 'auth-profile-password',
                        'icon' => 'fa fa-lock',
                        'order' => 3,
                        'active' => true,
                    ),
                )
            ),
            array(
                'route' => 'admin-index',
                'name' => 'Admin',
                'icon' => 'fa fa-gear',
                'order' => 99,
                'location' => 'left',
                'active' => true,
                'items' => array(
                    array(
                        'name' => 'Auth',
                        'route' => 'auth-index',
                        'icon' => 'fa fa-user',
                        'order' => 3,
                        'active' => true,
                    )
                )
            )
        )
    )
)
;