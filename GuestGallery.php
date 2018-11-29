<?php
require_once "model/Image.php";
require_once "model/view.php";
$data = [];
    $imageobj = new Image();
    $viewobj = new view();
    $data['results'] = $imageobj->whereClause([
        'view_status'=>1,
    ]);

    
$viewobj->display('GuestGallery',$data);
?>