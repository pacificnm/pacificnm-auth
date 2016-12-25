<?php
namespace Auth\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\AbstractApplicationController;
use Auth\Service\ServiceInterface;
use Auth\Form\Form;
use Auth\Form\ProfileForm;

class UpdateController extends AbstractApplicationController
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
     * @var ProfileForm
     */
    protected $profileForm;
    
    /**
     * 
     * @param ServiceInterface $service
     * @param Form $form
     * @param ProfileForm $profileForm
     */
    public function __construct(ServiceInterface $service, Form $form, ProfileForm $profileForm)
    {
        $this->service = $service;
        
        $this->form = $form;
        
        $this->profileForm = $profileForm;
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
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('object was not found');
        
            return $this->redirect()->toRoute('auth-index');
        }
        
        if ($request->isPost()) {
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            if ($this->form->isValid()) {
                $entity = $this->form->getData();
        
                $authEntity = $this->service->save($entity);
        
                $this->getEventManager()->trigger('authUpdate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'authEntity' => $authEntity
                ));
        
                $this->flashMessenger()->addSuccessMessage('Object was saved');
        
                return $this->redirect()->toRoute('auth-view', array(
                    'id' => $authEntity->getAuthId()
                ));
            }
        }
        
        $this->form->bind($entity);
        
        return new ViewModel(array(
            'entity' => $entity,
            'form' => $this->form
        ));
    }
    
    /**
     * 
     * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
     */
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
        
            $this->profileForm->setData($postData);
        
            if ($this->profileForm->isValid()) {
                
                $entity = $this->profileForm->getData();
        
                $authEntity = $this->service->save($entity);
        
                $this->getEventManager()->trigger('authProfileUpdate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'authEntity' => $authEntity
                ));
        
                $this->flashMessenger()->addSuccessMessage('Your settings where saved');
        
                return $this->redirect()->toRoute('auth-profile-index');
            }
        
        }
        
        $this->profileForm->bind($entity);
        
        return new ViewModel(array(
            'entity' => $entity,
            'form' => $this->profileForm
        ));
    }
}