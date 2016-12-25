<?php
namespace Auth\Form;

use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Entity\Entity;
use Auth\Hydrator\Hydrator;
use AclRole\Service\ServiceInterface as RoleServiceInterface;

class Form extends ZendForm implements InputFilterProviderInterface
{

    /**
     *
     * @var RoleServiceInterface
     */
    protected $roleService;

    /**
     *
     * @param RoleServiceInterface $roleService            
     * @param string $name            
     * @param array $options            
     */
    function __construct(RoleServiceInterface $roleService, $update = false, $name = 'auth-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new Hydrator(false));
        
        $this->setObject(new Entity());
        
        $this->roleService = $roleService;
        
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
            'type' => 'Select',
            'name' => 'aclRoleId',
            'options' => array(
                'label' => 'Role:',
                'value_options' => $this->getAclRoleOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'aclRoleId'
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
        
        if($update) {
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
                    'label' => 'confirmPassword:'
                ),
                'attributes' => array(
                    'class' => 'form-control',
                    'id' => 'authPassword'
                )
            ));
        } else {
            // authPassword
            $this->add(array(
                'name' => 'authPassword',
                'type' => 'hidden',
                'attributes' => array(
                    'id' => 'authPassword'
                )
            ));
        }
       
        
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth E-Mail is required and cannot be empty."
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Password is required and cannot be empty."
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Name is required and cannot be empty."
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

    /**
     *
     * @return NULL[]
     */
    protected function getAclRoleOptions()
    {
        $options = array();
        
        $entitys = $this->roleService->getAll(array(
            'pagination' => 'off'
        ));
        
        foreach ($entitys as $entity) {
            $options[$entity->getAclRoleId()] = ucwords($entity->getAclRoleName());
        }
        
        return $options;
    }
}