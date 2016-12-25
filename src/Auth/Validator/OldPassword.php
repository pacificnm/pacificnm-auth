<?php
namespace Auth\Validator;

use Zend\Validator\AbstractValidator;
use Auth\Service\AuthServiceInterface;
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
