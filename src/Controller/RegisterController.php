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
use Pacificnm\Auth\Form\RegisterForm;



class RegisterController extends AbstractApplicationController
{
    /**
     * 
     * @var ServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @var RegisterForm
     */
    protected $form;
    
    /**
     * 
     * @param ServiceInterface $service
     * @param RegisterForm $form
     */
    public function __construct(ServiceInterface $service, RegisterForm $form)
    {
        $this->form = $form;
        
        $this->service = $service;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
       
        if(! $this->CanRegister()) {
            return $this->redirect()->toRoute('auth-sign-in');
        }
        
        // @todo move to config in router section and add to page in the database so we can assign layout at page level
        $this->layout('/layout/sign-in.phtml');
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            if ($this->form->isValid()) {
        
                $bcrypt = new Bcrypt();
        
                $entity = $this->form->getData();
        
                $entity->setAuthPassword($bcrypt->create($entity->getAuthPassword()));
        
                $authEntity = $this->service->save($entity);
        
                $this->getEventManager()->trigger('authRegister', $this, array(
                    'authId' => $authEntity->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'authEntity' => $authEntity
                ));
        
                $this->flashmessenger()->addSuccessMessage('Account was created. Please sign in to complete setting up your account.');
        
                return $this->redirect()->toRoute('auth-sign-in');
            }
        }
        
        $this->form->get('authLastLogin')->setValue(0);
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}

