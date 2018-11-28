<?php

require 'DB.php';

class User extends DB {
   

    function __construct()
    {
        $this->setTable('users');
        $this->setFields('email','firstname','lastname','password');
        $this->db = $this->connect();
       
        
    }
  

}