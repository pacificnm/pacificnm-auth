<?php
namespace Auth\Controller;

use Zend\View\Model\ViewModel;
use Auth\Form\PasswordForm;
use Zend\Crypt\Password\Bcrypt;
use Application\Controller\AbstractApplicationController;
use Auth\Service\ServiceInterface;

class PasswordController extends AbstractApplicationController
{
    /**
     * 
     * @var ServiceInterface
     */
    protected $sservice;

    /**
     * 
     * @var PasswordForm
     */
    protected $form;
    
    /**
     * 
     * @param ServiceInterface $service
     * @param PasswordForm $form
     */
    public function __construct(ServiceInterface $service, PasswordForm $form)
    {
        $this->service = $service;
        
        $this->form = $form;
    }
    
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
    
        $request = $this->getRequest();
        
        $id = $this->params()->fromRoute('id');
    
        $entity = $this->service->get($id);
    
        if(! $entity) {
            $this->flashmessenger()->addErrorMessage('object not found');       
            return $this->redirect()->toRoute('auth-index');
        }
        
       
        if ($request->isPost()) {
            $postData = $request->getPost();
            $this->form->setData($postData);
            
            if ($this->form->isValid()) {
                $entity = $this->form->getData();
    
                $bcrypt = new Bcrypt();
                
                $entity->setAuthPassword($bcrypt->create($entity->getAuthPassword()));
                
                $authEntity = $this->service->save($entity);
    
                $this->getEventManager()->trigger('authPassword', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'authEntity' => $authEntity
                ));
                
                $this->flashmessenger()->addSuccessMessage('The password was reset.');
    
                return $this->redirect()->toRoute('auth-view', array(
                    'id' => $authEntity->getAuthId()
                ));
            }
        }
    
        $this->form->bind($entity);
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
    
    public function profileAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $id = $this->identity()->getAuthId();
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Please sign in to access your profile');
        
            return $this->redirect()->toRoute('auth-sign-in');
        }
        
        if ($request->isPost()) {
            $postData = $request->getPost();
            $this->form->setData($postData);
        
            if ($this->form->isValid()) {
                $entity = $this->form->getData();
        
                $bcrypt = new Bcrypt();
        
                $entity->setAuthPassword($bcrypt->create($entity->getAuthPassword()));
        
                $authEntity = $this->service->save($entity);
        
                $this->getEventManager()->trigger('authProfilePassword', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'authEntity' => $authEntity
                ));
        
                $this->flashmessenger()->addSuccessMessage('The password was saved.');
        
                return $this->redirect()->toRoute('auth-profile-index');
            }
        }
        
        $this->form->bind($entity);
        
        return new ViewModel(array(
            'entity' => $entity,
            'form' => $this->form
        ));
    }
}
