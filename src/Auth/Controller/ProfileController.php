<?php
namespace Auth\Controller;

use Application\Controller\AbstractApplicationController;
use Auth\Service\ServiceInterface;
use Zend\View\Model\ViewModel;


class ProfileController extends AbstractApplicationController
{
    /**
     * 
     * @var ServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $id = $this->identity()->getAuthId();
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Please sign in to access your profile');
        
            return $this->redirect()->toRoute('auth-sign-in');
        }
        
        $this->getEventManager()->trigger('authProfileIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'requestUrl' => $this->getRequest()->getUri(),
            'authEntity' => $entity
        ));
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

