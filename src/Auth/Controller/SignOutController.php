<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;

class SignOutController extends AbstractActionController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
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