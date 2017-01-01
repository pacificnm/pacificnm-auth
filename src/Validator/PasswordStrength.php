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

class PasswordStrength extends AbstractValidator
{
    /**
     * 
     * @var string
     */
    const LENGTH = 'length';
    
    /**
     * 
     * @var string
     */
    const UPPER  = 'upper';
    
    /**
     * 
     * @var string
     */
    const LOWER  = 'lower';
    
    /**
     * 
     * @var string
     */
    const DIGIT  = 'digit';
    
    /**
     * 
     * @var array
     */
    protected $messageTemplates = array(
        self::LENGTH => "Your Password must be at least 8 characters in length",
        self::UPPER  => "Your Password must contain at least one uppercase letter",
        self::LOWER  => "Your Password must contain at least one lowercase letter",
        self::DIGIT  => "Your Password must contain at least one digit character"
    );
    
    /**
     * 
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);
    }
    
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Validator\ValidatorInterface::isValid()
     */
    public function isValid($value)
    {
        $this->setValue($value);
        
        $isValid = true;
        
        if (strlen($value) < 8) {
            $this->error(self::LENGTH);
            $isValid = false;
        }
        
        if (!preg_match('/[A-Z]/', $value)) {
            $this->error(self::UPPER);
            $isValid = false;
        }
        
        if (!preg_match('/[a-z]/', $value)) {
            $this->error(self::LOWER);
            $isValid = false;
        }
        
        if (!preg_match('/\d/', $value)) {
            $this->error(self::DIGIT);
            $isValid = false;
        }
        
        return $isValid;
    }
}