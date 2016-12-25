<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{
    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;
    
    /**
     *
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
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
        $this->layout()->setVariable('pageTitle', 'Auth');
    
        $this->layout()->setVariable('pageSubTitle', 'Delete');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
    
        $id = $this->params()->fromRoute('authId');
    
        $authEntity = $this->authService->get($id);
    
        if(! $authEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the auth ' . $id);
            
            return $this->redirect()->toRoute('auth-index');
        }
    
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
               
                $this->authService->delete($authEntity);
                
                $this->flashmessenger()->addSuccessMessage('The auth was deleted');
                
                return $this->redirect()->toRoute('auth-index');
            }
            
            return $this->redirect()->toRoute('auth-view', array('authId' => $authEntity->getAuthId()));
        }
    
        return new ViewModel(array(
            'authEntity' => $authEntity
        ));
    }
}
