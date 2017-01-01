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
use Pacificnm\Auth\Form\ResetForm;
use Pacificnm\Auth\Service\ServiceInterface;
use Pacificnm\Config\Service\ServiceInterface as ConfigServiceInterface;
use Pacificnm\Config\Entity\Entity as ConfigEntity;

class ResetPasswordController extends AbstractApplicationController
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @var ConfigServiceInterface
     */
    protected $configService;

    /**
     *
     * @var ResetForm
     */
    protected $form;

    /**
     *
     * @param ServiceInterface $service            
     * @param ConfigServiceInterface $configService            
     * @param ResetForm $form            
     */
    public function __construct(ServiceInterface $service, ConfigServiceInterface $configService, ResetForm $form)
    {
        $this->service = $service;
        
        $this->configService = $configService;
        
        $this->form = $form;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        if(! $this->CanResetPassword()) {
            return $this->redirect()->toRoute('auth-sign-in');
        }
        
        $configEntity = $this->configService->get(1);
        
        if(! $this->validateEmailSetting($configEntity)) {
            $this->flashMessenger()->addErrorMessage('E-Mail not configured. Please check the SMTP settings');
            
            return $this->redirect()->toRoute('auth-sign-in');
        }
        
        $this->layout('/layout/sign-in.phtml');
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            if ($this->form->isValid()) {}
        }
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }

    /**
     * 
     * @param ConfigEntity $configEntity
     * @return boolean
     */
    protected function validateEmailSetting(ConfigEntity $configEntity)
    {
        if (empty($configEntity->getConfigSmtpDisplay()) || empty($configEntity->getConfigSmtpEmail() || empty($configEntity->getConfigSmtpHost()))) {
            return false;
        } else {
            return true;
        }
    }
}

