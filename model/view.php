<?php
class view
{
   
    function display($filename,$details=[],$header='header',$footer='footer'){
        extract($details);
         require_once 'includes/'.$header.'.php'; 
     
         require_once 'views/'.$filename.'.php'; 
      
         require_once 'includes/'.$footer.'.php'; 
     
    }
}
?>