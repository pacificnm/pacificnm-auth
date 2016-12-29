<?php
use Auth\View\Helper\AuthNavBar;
return array(
    'module' => array(
        'Auth' => array(
            'name' => 'Auth',
            'version' => '1.0.4',
            'install' => array(
                'require' => array(),
                'sql' => 'sql/auth.sql'
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Auth\Controller\SignInController' => 'Auth\Controller\Factory\SignInControllerFactory',
            'Auth\Controller\SignOutController' => 'Auth\Controller\Factory\SignOutControllerFactory',
            'Auth\Controller\IndexController' => 'Auth\Controller\Factory\IndexControllerFactory',
            'Auth\Controller\CreateController' => 'Auth\Controller\Factory\CreateControllerFactory',
            'Auth\Controller\DeleteController' => 'Auth\Controller\Factory\DeleteControllerFactory',
            'Auth\Controller\UpdateController' => 'Auth\Controller\Factory\UpdateControllerFactory',
            'Auth\Controller\ViewController' => 'Auth\Controller\Factory\ViewControllerFactory',
            'Auth\Controller\PasswordController' => 'Auth\Controller\Factory\PasswordControllerFactory',
            'Auth\Controller\ProfileController' => 'Auth\Controller\Factory\ProfileControllerFactory',
            'Auth\Controller\RegisterController' => 'Auth\Controller\Factory\RegisterControllerFactory',
            'Auth\Controller\ResetPasswordController' => 'Auth\Controller\Factory\ResetPasswordControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Auth\Adapter\AuthAdapter' => 'Auth\Adapter\Factory\AuthAdapterFactory',
            'Auth\Adapter\OAuth2Adapter' => 'Auth\Adapter\Factory\OAuth2AdapterFactory',
            'Auth\Mapper\MysqlMapperInterface' => 'Auth\Mapper\Factory\MysqlMapperFactory',
            'Auth\Service\ServiceInterface' => 'Auth\Service\Factory\ServiceFactory',
            'Auth\Form\PasswordForm' => 'Auth\Form\Factory\PasswordFormFactory',
            'Auth\Form\Form' => 'Auth\Form\Factory\FormFactory',
            'Auth\Form\CreateForm' => 'Auth\Form\Factory\CreateFormFactory',
            'Auth\Form\ResetForm' => 'Auth\Form\Factory\ResetFormFactory',
            'Auth\Form\ProfileForm' => 'Auth\Form\Factory\ProfileFormFactory'
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
                        'controller' => 'Auth\Controller\ProfileController',
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
                        'controller' => 'Auth\Controller\UpdateController',
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
                        'controller' => 'Auth\Controller\PasswordController',
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
                        'controller' => 'Auth\Controller\ResetPasswordController',
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
                        'controller' => 'Auth\Controller\RegisterController',
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
                        'controller' => 'Auth\Controller\SignInController',
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
                        'controller' => 'Auth\Controller\SignOutController',
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
                        'controller' => 'Auth\Controller\IndexController',
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
                        'controller' => 'Auth\Controller\CreateController',
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
                        'controller' => 'Auth\Controller\UpdateController',
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
                        'controller' => 'Auth\Controller\ViewController',
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
                        'controller' => 'Auth\Controller\DeleteController',
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
                        'controller' => 'Auth\Controller\PasswordController',
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
            'AuthNavBar' => 'Auth\View\Helper\AuthNavBar',
            'AuthAside' => 'Auth\View\Helper\AuthAside'
        ),
        'factories' => array(
            'AuthSearchForm' => 'Auth\View\Helper\Factory\AuthSearchFormFactory'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    'acl' => array(
        'default' => array(
            'guest' => array(
                'auth-sign-in',
                'auth-register-index',
                'auth-reset-password-index'
            ),
            'user' => array(
                'auth-profile-index',
                'auth-profile-update',
                'auth-profile-password',
                'auth-sign-out',
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