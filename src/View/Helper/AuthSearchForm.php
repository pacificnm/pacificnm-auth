<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Pacificnm\AclRole\Service\ServiceInterface;

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

    /**
     * 
     * @param array $queryParams
     */
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

