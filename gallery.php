<?php
require_once "model/Image.php";
require_once "model/view.php";
require_once "model/Validation.php";
require_once "model/Album.php";
$image = [];
$data = [];
$object = new Image();
$viewobj = new view();
$albumobj = new Album(); 
$time = date("Y-m-d H:i:s");
$image_selected = FALSE;
$image_selected = isset($_POST['image-upload'])??TRUE;
$selected = FALSE;
$selected = isset($_POST['update-album'])??TRUE;
if(!empty($_GET))
{
    $_SESSION['album_id'] = $_GET['album_id'];
}
if($image_selected)
{   
    $validation = new Validation([
    'caption'=>$_POST['caption'],
    'view_status'=>$_POST['view_status'],
    ]);
    $validation->rules('caption','required');
    $validation->rules('view_status','required');
    
    if($validation->valid())
    {
        $image['caption']  = $_POST['caption'];
        $extensions = ['jpg','jpeg','png'];
        $files_ext =  explode("/",$_FILES['album-image']['type']);
   
    
        if(in_array($files_ext[1],$extensions))
        
        {  
        $extension = $files_ext[1];
            
        $image_name =  str_replace('.',"",microtime(TRUE));
        $image_name.=".";
        $image_name.=$extension;
        $image['caption'] = $_POST['caption'];
        $image['size'] = $_FILES['album-image']['size'];
        $image['ext'] = $extension;
        $image['mime'] = $_FILES['album-image']['type'];
        $image['original_name'] = $_FILES['album-image']['name']; 
        $image['user_id'] = $_SESSION['user_id'];
        $image['album_id'] = $_SESSION['album_id'];
        $image['image_name'] = $image_name;
        $image['created_at'] = $time;
        $image['updated_at'] = $time;
        $image['view_status'] = $_POST['view_status'];
        $var = move_uploaded_file($_FILES['album-image']['tmp_name'],'images/'.$image['image_name']);

            if($var)
            {  
                $filename = 'images/'.$image['image_name'];
                list($width, $height) = getimagesize($filename);
                $ratio = $width/$height;
                $new_width =200;
                $new_height = 150;
                if(($new_width/$new_height)>$ratio)
                {
                    $new_width = $new_height*$ratio;
                }
                else
                {
                    $new_height = $new_width/$ratio;
                }
                $image_p = imagecreatetruecolor($new_width, $new_height);
                $path = 'images/thumbnail/thumb_'.$image['image_name'];
                if($extension == 'jpeg')
                {
                    $imagecreated = imagecreatefromjpeg($filename);
                    imagecopyresampled($image_p, $imagecreated, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    $thumnailCreated = imagejpeg($image_p,$path);
                }
                if($extension == 'png')
                {
                    $imagecreated = imagecreatefrompng($filename);
                    imagecopyresampled($image_p, $imagecreated, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    $thumnailCreated =  imagepng($image_p,$path);

                }
                if($extension == 'gif')
                {
                    $imagecreated = imagecreatefromgif($filename);
                    imagecopyresampled($image_p,$imagecreated,0,0,0,0,$new_width,$new_height,$width,$height);
                    $thumnailCreated = imagegif($image_p,$path,100);
                }
                if($thumnailCreated)
                {
                $result = $object->insert($image);
                if($result)
                {
                    header("Location: gallery.php");
                }

                }

            

            
                
            }
      
        }
    }             
   

 }

$selected = isset($_POST['update-album'])??TRUE;
if($selected)
{
    $update_var = new Validation([
        'name'=>$_POST['name'],
        'description'=>$_POST['description'],
    ]);
   $update_var->rules('name','required');
   $update_var->rules('description','required');
   if($update_var->valid())
   {    $_SESSION['album_id'];
        $_POST['name'];
        $_POST['description'];
       $status = $albumobj->updatefield($_SESSION['album_id'],$_POST['name'],$_POST['description'],$time);
       if($status)
       {
           header("Location: profile.php");
       }

   }

}
$delete = FALSE;
$delete = isset($_POST['delete-image'])??TRUE;
if($delete)
{
$deleted_time = date("Y-m-d H:i:s");
// print_r($_POST);
if($object->delete($_POST['hidden-field'],$deleted_time))
{
    header("Location: gallery.php");

}

}
$result = $object->whereClause([
    'user_id'=>$_SESSION['user_id'],
    'album_id'=>$_SESSION['album_id']
]);
$data['images'] = $result;
$album_details=$albumobj->getRecord($_SESSION['album_id']);
$data['album_details'] = $album_details;
// echo '<pre>';
// print_r($data);
$viewobj->display('gallery',$data);

?>