<?php
namespace Auth\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\AbstractApplicationController;
use Auth\Service\ServiceInterface;

class IndexController extends AbstractApplicationController
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
        
        $this->getEventManager()->trigger('authIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'requestUrl' => $this->getRequest()->getUri()
        ));
        

        $filter = array(
            'page' => $this->page,
            'count-per-page' => $this->countPerPage,
            'authName' => $this->params()->fromQuery('authName', null),
            'authEmail' => $this->params()->fromQuery('authEmail', null),
            'aclRoleId' => $this->params()->fromQuery('aclRoleId', null),
        );
        
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($filter['page']);
        
        $paginator->setItemCountPerPage($filter['count-per-page']);
        
        return new ViewModel(array(
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