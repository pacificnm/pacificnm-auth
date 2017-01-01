<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Controller;

use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;
use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\Auth\Service\ServiceInterface;
use Pacificnm\Auth\Form\PasswordForm;

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
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $id = $this->params()->fromRoute('id');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
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
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'requestUrl' => $this->getRequest()
                        ->getUri(),
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
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'requestUrl' => $this->getRequest()
                        ->getUri(),
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
