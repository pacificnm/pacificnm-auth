<?php
namespace Auth\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Service\ServiceInterface;

class ResetForm extends Form implements InputFilterProviderInterface
{
    protected $service;

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \Auth\Form\ResetForm
     */
    function __construct(ServiceInterface $service, $name = 'auth-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->service = $service;
        
        // authEmail
        $this->add(array(
            'name' => 'authEmail',
            'type' => 'Email',
            'options' => array(
                'label' => 'E-Mail:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authEmail'
            )
        ));
        
        // button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
        
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // authEmail
            'authEmail' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Your E-Mail Address is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'Auth\Validator\EmailExists',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'service' => $this->service,
                        )
                    )
                )
            )
        );
    }
}

