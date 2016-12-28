<?php
namespace Auth\Validator;

use Zend\Validator\AbstractValidator;

class EmailExists extends AbstractValidator
{

    protected $service;

    /**
     *
     * @var string
     */
    const EMAIL_ADDRESS_NOT_FOUND = 'emailAddressNotFound';

    /**
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::EMAIL_ADDRESS_NOT_FOUND => 'We did not find an account with the e-mail address you provided.'
    );

    /**
     *
     * @param array $options            
     * @throws \Exception
     */
    public function __construct($options = null)
    {
        if ($options && is_array($options) && array_key_exists('service', $options)) {
            $this->service = $options['service'];
        } else {
            throw new \Exception('Service not set');
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Validator\ValidatorInterface::isValid()
     */
    public function isValid($value)
    {
        $this->setValue($value);
        
        $entity = $this->service->getAuthByEmail($value);
        
        if (! $entity) {
            $isValid = false;
            
            $this->error(self::EMAIL_ADDRESS_NOT_FOUND);
        } else {
            $isValid = true;
        }
        
        return $isValid;
    }
}

