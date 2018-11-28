<?php
    function ak_img_resize($target,$newcopy,$w,$h,$ext)
{
    list($w_orig,$h_orig) = getimagesize($target);
    $scale_ratio = $w_orig/$h_orig;
    if($w/$h>$scale_ratio)
    {
        $w = $h*$scale_ratio;
    }
    else
    {
        $h = $w/$scale_ratio;
    }
    $img = "";
    
        if($ext == 'GIF' ||$ext == 'gif')
        {
            $img = imagecreatefromgif($target);
        }
        elseif($ext == 'PNG' ||$ext == 'png')
        {
            $img = imagecreatefrompng($target);
        }
        else
        {
            $img = imagecreatefromjpeg($target);
        }
        

}





?>
