<?php
require_once 'DB.php';
class Album extends DB
{
    function __construct()
    {
        $this->setTable('albums');
        $this->setFields('name','description','user_id','created_at','updated_at');
        $this->db = $this->connect();
    }

    function getLatestImage($id){
        $sql = "SELECT image_name from images where album_id=:id ORDER BY created_at DESC LIMIT 0,1";
        $stm = $this->db->prepare($sql);
        $stm->execute(['id' => $id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

}
?>