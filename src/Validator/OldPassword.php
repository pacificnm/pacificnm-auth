<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Validator;

use Zend\Validator\AbstractValidator;
use Pacificnm\Auth\Service\AuthServiceInterface;
use Zend\Crypt\Password\Bcrypt;

class OldPassword extends AbstractValidator
{
    /**
     * 
     * @var string
     */
    const NOT_VALID = 'The password you provided does not match the password saved for your account';

    /**
     * 
     * @var AuthServiceInterface
     */
    protected $authService;
    
    /**
     * 
     * @var array
     */
    protected $messageTemplates = array(
        self::NOT_VALID => 'The password you provided does not match the password saved for your account'
    );
    
    /**
     * 
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);
        
        $this->authService = $options['authService'];
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Validator\ValidatorInterface::isValid()
     */
    public function isValid($value,  $context = null)
    {
        $this->setValue($value);
        
        $bcrypt = new Bcrypt();
        
        $isValid = true;
        
        $authEntity = $this->authService->get($context['authId']);
        
        // if no auth entity return not valid
        if(! $authEntity) {
            $this->error(self::NOT_VALID);
            $isValid = false;
            
            return $isValid;
        }
        
        
        if(! $bcrypt->verify($value, $authEntity->getAuthPassword())) {
            $this->error(self::NOT_VALID);
            $isValid = false;
        }
        
        return $isValid;
    }
}
