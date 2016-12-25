<?php
namespace Auth\View\Helper;

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