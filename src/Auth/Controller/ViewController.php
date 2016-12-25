<?php
namespace Auth\Controller;

use Zend\View\Model\ViewModel;
use Auth\Service\ServiceInterface;
use Application\Controller\AbstractApplicationController;

class ViewController extends AbstractApplicationController
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
     * {@inheritdoc}
     *
     * @see \Application\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        // auth id
        $id = $this->params()->fromRoute('id');
        
        // get auth entity
        $entity = $this->service->get($id);
        
        // validate we got an auth
        if (! $entity) {
            $this->flashmessenger()->addErrorMessage('Object not found');
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        $this->getEventManager()->trigger('authView', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'requestUrl' => $this->getRequest()->getUri(),
            'authEntity' => $entity
        ));
        
        // return view model
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}