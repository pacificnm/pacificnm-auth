<?php
namespace Auth\View\Helper;

use Zend\View\Helper\AbstractHelper;
use AclRole\Service\ServiceInterface;

class AuthSearchForm extends AbstractHelper
{

    /**
     *
     * @var ServiceInterface
     */
    protected $aclRoleService;

    /**
     *
     * @param ServiceInterface $aclRoleService            
     */
    public function __construct(ServiceInterface $aclRoleService)
    {
        $this->aclRoleService = $aclRoleService;
    }

    public function __invoke(array $queryParams = array())
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $roleEntitys = $this->aclRoleService->getAll(array(
            'pagination' => 'off'
        ));
        
        $data = new \stdClass();
        
        $data->roleEntitys = $roleEntitys;
        
        $data->queryParams = $queryParams;
        
        return $partialHelper('partials/auth-search-form.phtml', $data);
    }
}

