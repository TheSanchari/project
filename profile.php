<?php

require_once "model/view.php";
require_once "model/Validation.php";
require_once "model/Album.php";
require_once "model/Image.php";
$data = [];

$obj = new view();
$date = date("Y-m-d H:i:s");
$selected = FALSE;
$selected = isset($_POST['album-submit'])??TRUE;
$album = new Album();
$imageObj = new Image();
$args = [
    'user_id'=>$_SESSION['user_id'],
];
// print_r($args);
$albums = $album->whereClause($args);

$albums = array_map(function($row) use(&$album){
    $row['last_image'] = $album->getLatestImage($row['id']);
    return $row;
},$albums);

 $data['albums'] = $albums;
// echo '<pre>';
//  print_r($data['albums']);

if($selected)
{
    $validation = new Validation($_POST);
    $validation->rules('name','required');
    $validation->rules('description','required');
    $validation->exclude('album-submit');
    if($validation->valid())
    {
       $albumobj = new Album();
       $var = $albumobj->insert([
            'name'=>$_POST['name'],
            'description'=>$_POST['description'],
            'user_id'=>$_SESSION['user_id'],
            'created_at'=>$date,
            'updated_at'=>$date,
            ]);
        if($var)
            {
                $_SESSION['success'] =  "Album has been successfully created";
                header("Location: http://localhost/project-2/profile.php");

            }
            else
            {
                $_SESSION['error'] = "problem while creating the album";
            }
    }
    else
    {
        $_SESSION['error'] = "Please fill up all the fields";
    }

}
$obj->display('profile',$data);
?>