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
use Pacificnm\Auth\Service\ServiceInterface;
use Pacificnm\Controller\AbstractApplicationController;

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
     * {@inheritDoc}
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
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