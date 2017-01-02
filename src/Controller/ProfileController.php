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
use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\Auth\Service\ServiceInterface;
use Pacificnm\History\Service\ServiceInterface as HistoryServiceInterface;

class ProfileController extends AbstractApplicationController
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     * 
     * @var HistoryServiceInterface
     */
    protected $historyService;
    
    /**
     *
     * @param ServiceInterface $service            
     */
    public function __construct(ServiceInterface $service,  HistoryServiceInterface $historyService)
    {
        $this->service = $service;
        
        $this->historyService = $historyService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
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
            'authId' => $this->identity()
                ->getAuthId(),
            'requestUrl' => $this->getRequest()
                ->getUri(),
            'authEntity' => $entity
        ));
        
        $filter = array(
            'page' => $this->page,
            'count-per-page' => $this->countPerPage,
            'authId' => $this->identity()->getAuthId(),
            'historyRequestTimeDesc' => 1
        ); 
        
        $paginator = $this->historyService->getAll($filter);
        
        $paginator->setCurrentPageNumber($filter['page']);
        
        $paginator->setItemCountPerPage($filter['count-per-page']);
        
        return new ViewModel(array(
            'entity' => $entity,
            'paginator' => $paginator,
            'page' => $filter['page'],
            'count-per-page' => $filter['count-per-page'],
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => $this->params()->fromRoute()
        ));
    }
}

