<?php
namespace Auth\Controller;

use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;
use Zend\Mvc\Controller\AbstractActionController;
use Auth\Service\ServiceInterface;
use Auth\Form\Form;

class CreateController extends AbstractActionController
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
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
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
