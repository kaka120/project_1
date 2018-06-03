<?php
namespace Hello\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HelloController extends AbstractActionController
{
public function indexAction()
{
$text = "I was set on the controller, but will appear in the view";
return new ViewModel(array(

'example' => $text,

));

}

}


