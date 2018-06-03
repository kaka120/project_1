<?php
namespace Application\Form;
use Zend\Form\Element;
use Zend\Form\Form;

class contactForm extends Form
{
    public function __construct()
    {
    parent::__construct();
   $this->add([
           'name' => 'id',
            'type'=>  'text',
            'attributes'=>
            [
                'class'=>'form-control'  
            ],
            'options' => [
            'label' => 'Your your name',
                         ],
        ]);
   $this->add([
               'name' => 'name',
                    'type'=>  'text',
                     'attributes'=>
                       [
                         'class'=>'form-control'  
                       ],
                    'options' => [
                        'label' => 'Enter your Subject',
                    ],
                   
        ]);

    
    $this->add([
                 'name' => 'send',
                'type'  => 'Submit',
                'attributes' => [
                    'value' => 'Submit',
                    'class'=>'btn btn-primary btn-block'
                    
                ],
                   
        ]);
    }
}

?>