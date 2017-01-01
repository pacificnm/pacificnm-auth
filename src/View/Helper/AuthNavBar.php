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

class AuthNavBar extends AbstractHelper
{
    /**
     * 
     */
    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        // set partial script
        return $partialHelper('partials/auth-nav-bar.phtml');
    }
}