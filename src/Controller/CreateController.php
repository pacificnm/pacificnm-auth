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
use Pacificnm\Auth\Form\Form;


class CreateController extends AbstractApplicationController
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @var Form
     */
    protected $form;

    /**
     *
     * @param ServiceInterface $service            
     * @param Form $form            
     */
    public function __construct(ServiceInterface $service, Form $form)
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
                
                $this->getEventManager()->trigger('authCreate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'authEntity' => $authEntity
                ));
                
                $this->flashmessenger()->addSuccessMessage('Object was saved.');
                
                return $this->redirect()->toRoute('auth-view', array(
                    'id' => $authEntity->getAuthId()
                ));
            }
        }
        
        $this->form->get('authLastLogin')->setValue(0);
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}
