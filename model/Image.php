<?php
require_once 'DB.php';
class Image extends DB
{
function __construct()
{   
    $this->setTable('images');
    $this->setFields('caption','size','ext','mime','original_name','user_id','album_id','image_name','created_at','updated_at','view_status');
    $this->DB = $this->connect();
    

}


}
?>