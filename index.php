<?php

require_once "model/User.php";
require_once "model/view.php";
require_once "model/Validation.php";
$data = [
    
];



$obj = new view();
$selected = FALSE;
$selected = isset($_POST['login-submit'])??TRUE;

if($selected)
{
    $object  = new Validation([
       'email'=>$_POST['email'],
       'password'=>$_POST['password'],
    ]);
    $object->rules('email','required|email');
    $object->rules('password','required');
    // $object->exclude('login-submit');
    if($object->valid())
     
    
    {   
       
            $user = new user();
            $result = $user->whereClause([
            'email'=>$_POST['email'],
            'password'=>$_POST['password'],
                ]);
            if($result)
            {
             $_SESSION['user_id'] = $result[0]['id'];
              header("Location: profile.php");

            }
          
             $data['error'] = "please enter valid credentials";
            // print_r($data);
                
               
            

    

       
    }

    $data =$object->geterror();

}

$obj->display('login',$data);
?>