<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use zend\InputFilter\InputFilter;
use Zend\Form\Factory;
use Zend\Hydrator\ArraySerializable;
use Application\form\contactForm;
use Application\form\regForm;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
class IndexController extends AbstractActionController
{
    private $adapter;
    
    public function __constract()
    {
    $adapter = new Adapter([
    'driver'   => 'Mysqli',
    'database' => 'zf2_test',
    'username' => 'root',
    'password' => '',
                        ]);
        
    }
    public function indexAction()
    {
        return new ViewModel();
    }
     public function aboutAction()
    {
   /* $adapter = new Adapter([
    'driver'   => 'Mysqli',
    'database' => 'zf2_test',
    'username' => 'root',
    'password' => '',
                        ]);
        $res=$adapter->query("select name from user", Adapter::QUERY_MODE_EXECUTE);*///['data'=>$res]
        return new ViewModel();
    } 
    public function index1Action()
    {
    $adapter = new Adapter([
    'driver'   => 'Mysqli',
    'database' => 'zf2_test',
    'username' => 'root',
    'password' => '',
                        ]);
       // $res=$adapter->query("select name from user", Adapter::QUERY_MODE_EXECUTE);
        
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('USER1');
        $selectString = $sql->getSqlStringForSqlObject($select);
        $res = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        return new ViewModel(['data'=>$res]);
    } 
    public function addAction()
    {
     $adapter = new Adapter([
    'driver'   => 'Mysqli',
    'database' => 'zf2_test',
    'username' => 'root',
    'password' => '',
                        ]);
        
        

  if($this->getRequest()->isPost())//to check that submit button is pressed or not ... 
  {
       $sql = new Sql($adapter);//
    $insert = $sql->insert('USER1');
        
     $id= $this->getRequest()->getPost('id');
     $name= $this->getRequest()->getPost('name');
                   
      $data = array(
            'id'    => $id,
            'name'  => $name,
                  );


    $insert->values($data);
    $selectString = $sql->getSqlStringForSqlObject($insert);
    $results = $adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

      
  }
           
    $form=new contactForm();
    return new ViewModel(['form'=>$form]);
    }
    public function editAction()
    {
        $adapter = new Adapter([
                                    'driver'   => 'Mysqli',
                                    'database' => 'zf2_test',
                                    'username' => 'root',
                                    'password' => '',
                               ]);
        $params=[//parameter initilization part uo can send it to the argument
                   'id'=> $this->params("id"),//id is getting from phtml page
                ];
        if($this->getRequest()->isPost())
        {
               $id1= $this->getRequest()->getPost('id');
               $name= $this->getRequest()->getPost('name');
                   
              $data1 = array(
                            'id'    => $id1,
                            'name'  => $name,
                         );
            
       
            $sql = new Sql($adapter);
            $update = $sql->update();
            $update->table('USER1');
            $update->set($data1);
            $update->where(array('id' => $id1));
            $statement = $sql->prepareStatementForSqlObject($update);
             try {
                    $affectedRows = $statement->execute()->getAffectedRows();
                 } catch (\Exception $e) {
                   die('Error: ' . $e->getMessage());
                                         }
                    if (empty($affectedRows)) {
                        die('Zero rows affected');
                    }
            
            
            
            
        }
       
    //  $n = $db->update('bugs', $data, 'bug_id = 2');
        //database result set starts
        
        $sql = new Sql($adapter);
        $select = $sql->select();
        
        $select->from('USER1');
        $select->where(array('id' => $params));
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        
        //database result set ends
        //$result=$prepare->execute(1);
        $result=$results->current();
        $form=new regForm();
        
        return new ViewModel(['form'=>$form,'row'=>$result]);
    } 
    public function deleteAction()
    {
        
        
       $adapter = new Adapter([
                                    'driver'   => 'Mysqli',
                                    'database' => 'zf2_test',
                                    'username' => 'root',
                                    'password' => '',
                            ]);
          $params1=[//parameter initilization part uo can send it to the argument
                   'id'=> $this->params("id"),//id is getting from phtml page
                ];
           print_r($params1);
           $sql = new Sql($adapter);
           $del=$sql->delete('USER1');
           $del->where($params1);
           $statement = $sql->prepareStatementForSqlObject($del);
           $status=$statement->execute(); 
           return new ViewModel();      
    } 
    public function contactAction()
    {
       
       /*
       //form creation programatically data inilization part
       $name = new Element('name');
        $name->setLabel('Your name');
        $name->setAttributes([
            'type' => 'text',
            'class'=>'form-control'
                            ]);
        
        
        $email = new Element\Email('email');
        $email->setLabel('Your email address');
        $email->setAttributes([
            'class'=>'form-control'
                            ]);
        
        $subject = new Element('subject');
        $subject->setLabel('Subject');
        $subject->setAttributes([
                       'type' => 'text',
                       'class'=>'form-control'
                                ]);
        
        $message = new Element\Textarea('message');
        $message->setLabel('Message');
         $email->setAttributes([
            'class'=>'form-control'
                            ]);
        
        $csrf = new Element\Csrf('security');

        // Create a submit button:
        $send = new Element('Send');
        $send->setValue('Submit');
        $send->setAttributes([
            'type' => 'submit',
            'class'=>'btn btn-primary'
        ]);
        
        $form = new Form('Contact');
        
        $form->add($name);
        $form->add($email);
        $form->add($subject);
        $form->add($message);
        $form->add($csrf);
        $form->add($send);

        //['form'=>$form]*/
        
      /*  
        //form creation using factory method asrats
         $factory = new Factory();
        $form=$factory->createForm([
        'hydrator' => ArraySerializable::class,
        'elements' => [
            [
                'spec' => [
                    'name' => 'name',
                    'type'=>  'text',
                     'attributes'=>
                       [
                         'class'=>'form-control'  
                       ],
                      'options' => [
                        'label' => 'Your your name',
                                    ],
                          ],
            ],
            [
                'spec' => [
                    'type' => Element\Email::class,
                    'name' => 'email',
                    'attributes'=>
                       [
                         'class'=>'form-control'  
                       ],
                    'options' => [
                        'label' => 'Your email address',
                    ],
                ],
            ],
            [   'name' => 'send',
                'type'  => 'Submit',
                'attributes' => [
                    'value' => 'Submit',
                    'class'=>'btn btn-primary btn-block'
                    
                ],
                'spec' => [
                    'name' => 'subject',
                    'type'=>  'text',
                     'attributes'=>
                       [
                         'class'=>'form-control'  
                       ],
                    'options' => [
                        'label' => 'Enter your Subject',
                    ],
                   
                ],
            ],
        [
            'spec' => [
                'type' => Element\Textarea::class,
                'name' => 'message',
                 'attributes'=>
                       [
                         'class'=>'form-control' ,
                         'rows'=>5,ResultSet
                         'cols'=>80,
                       ],
                'options' => [
                    'label' => 'Enter your message',
                ]
            ],
        ],
  
        /*[//Rand function not supporting
            'spec' => [
                'name'=>'secirity',
                'type' => Element\Csrf::class,
                
            ],
        ],*/
   /*//
   
   [
            'spec' => [
                'name' => 'send',
                'type'  => 'Submit',
                'attributes' => [
                    'value' => 'Submit',
                    'class'=>'btn btn-primary btn-block'
                    
                ],
            ],
        ],
    ],
    //form creation using factory method ends

  
   
]);*/
        
        $form=new contactForm();
        return new ViewModel(['form'=>$form]);
    }
     public function haiAction()
    {
        return new ViewModel();
    } 
     public function dataAction()
    {
         $id=$this->params()->fromRoute('id');//getting data from route
         return new ViewModel(['id'=>$id]);
    }
    public function processAction()
    {
            $request=$this->getRequest();
            print_r($request->getPost());
    }

}
