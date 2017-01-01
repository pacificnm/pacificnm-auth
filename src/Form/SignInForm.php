<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Pacificnm\Auth\Hydrator\Hydrator;
use Pacificnm\Auth\Entity\Entity;

class SignInForm extends Form implements InputFilterProviderInterface
{

    /**
     * 
     * @param string $name
     * @param array $options
     * @return \Pacificnm\Auth\Form\SignInForm
     */
    function __construct($name = 'sign-in-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new Hydrator(false));
        
        $this->setObject(new Entity());
        
        
        // authEmail
        $this->add(array(
            'name' => 'authEmail',
            'type' => 'Text',
            'options' => array(
                'label' => 'Email:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authEmail',
                'placeholder' => 'Email',
            )
        ));
        
        // authPassword
        $this->add(array(
            'name' => 'authPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authPassword',
                'placeholder' => 'Password'
            )
        ));
        
        // button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Sign In',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-block btn-flat'
            )
        ));
        
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Email Address is required and cannot be empty"
                            )
                        )
                    )
                )
            ),
            
            'authPassword' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Password is required and cannot be empty"
                            )
                        )
                    )
                )
            )
        );
    }
}