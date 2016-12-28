<?php
namespace Auth\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\AbstractApplicationController;
use Auth\Service\ServiceInterface;

class DeleteController extends AbstractApplicationController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $id = $this->params()->fromRoute('id');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the auth ' . $id);
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $this->service->delete($entity);
                
                $this->getEventManager()->trigger('authDelete', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'requestUrl' => $this->getRequest()->getUri(),
                    'authEntity' => $entity
                ));
                
                $this->flashmessenger()->addSuccessMessage('The auth was deleted');
                
                return $this->redirect()->toRoute('auth-index');
            }
            
            return $this->redirect()->toRoute('auth-view', array(
                'authId' => $entity->getAuthId()
            ));
        }
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}
