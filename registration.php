<?php

require_once "model/view.php";
require_once "model/User.php";
require_once "model/Validation.php";
$data = [];

$selected = isset($_POST['register-submit'])?? FALSE;
if($selected)
{
    $validation = new Validation($_POST);
    $validation->rules('email','required|email');
    $validation->rules('password','required');
    $validation->rules('fname','required');
    $validation->rules('lname','required');
    $validation->exclude('register-submit');
    var_dump($validation->valid());
    if($validation->valid())
    {   
        $user = new User();
        $result = $user->duplicateEmail($_POST['email']);
        if($result)
        {
           $data['error']  = "Email already exists in the database";
        }
        else
        {
            $var = $user->insert([
                'firstname'=>$_POST['fname'],
                'lastname'=> $_POST['lname'],
                'email'=>  $_POST['email'],
                'password'=> $_POST['password'],
             ]);

 
            if($var)
            {
                $data['success'] =  "data has been added";
            }
            else
            {
                $data['error'] = "problem while inserting";
            }
           
        }
        
      
      


       




    }
    else
    {
        print_r($validation->geterror());
    }
    // $data = $error;
    
   
    

    


  
    // $user->getAllRecord();
    // $user->getRecord(1);

    
   
}
$obj = new view();
$obj->display('registration',$data);
?>