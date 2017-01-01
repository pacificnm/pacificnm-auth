<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Controller;

use Zend\Authentication\AuthenticationService;
use Pacificnm\Controller\AbstractApplicationController;

class SignOutController extends AbstractApplicationController
{
    /**
     *
     * @var AuthenticationService
     */
    protected $authService;
    
    /**
     *
     * @param AuthenticationService $authService
     */
    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        $this->authService->clearIdentity();
        
        $storage = $this->authService->getStorage()->clear();
        
        $_SESSION = array();
        
        $this->flashmessenger()->addSuccessMessage('You have been signed out.');
        
        return $this->redirect()->toRoute('auth-sign-in');
    }
}