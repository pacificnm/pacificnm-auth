<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link https://github.com/pacificnm/pacificnm-auth for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license https://github.com/pacificnm/pacificnm-auth/blob/master/LICENSE.md
 */
namespace Pacificnm\Auth\Form;

use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;
use Pacificnm\Auth\Hydrator\Hydrator;
use Pacificnm\Auth\Entity\Entity;

class RegisterForm extends ZendForm implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \Pacificnm\Auth\Form\RegisterForm
     */
    function __construct($name = 'register-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new Hydrator(false));
        
        $this->setObject(new Entity());
        
        // authId
        $this->add(array(
            'name' => 'authId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'authId'
            )
        ));
        
        // aclRoleId
        $this->add(array(
            'name' => 'aclRoleId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'aclRoleId',
                'value' => 3 // defaults to user
            )
        ));
        
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
        
        $this->add(array(
            'name' => 'authPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authPassword'
            )
        ));
        
        // match password
        $this->add(array(
            'name' => 'confirmPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Confirm Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'confirmPassword'
            )
        ));
        
        // authName
        $this->add(array(
            'name' => 'authName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authName'
            )
        ));
        
        // authLastLogin
        $this->add(array(
            'name' => 'authLastLogin',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'authLastLogin'
            )
        ));
        
        // authLastIp
        $this->add(array(
            'name' => 'authLastIp',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'authLastIp'
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
            // authId
            'authId' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            ),
            
            // aclRoleId
            'aclRoleId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Role is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
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
                    )
                )
            ),
            
            // authPassword
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Your Password is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authName
            'authName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Your Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authLastLogin
            'authLastLogin' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Last Login is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authLastIp
            'authLastIp' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            )
        );
    }
}

