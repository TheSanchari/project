<?php
require_once "Validation.php";
class FileValidation extends Validation
{
    public $filename;
    public $filetype;
    public $filesize;
    public $acceptedExtensions = [
        'jpg',
        'jpeg',
        'png'
    ];
    public $errors;
    public $imageDetails = [];
    public $imageValid;


    public function __construct(array $files)
    {   
    foreach($files as $file)
    {   $this->filename = $file['name'];
        $this->filetype = $file['type'];
        $this->filesize = $file['size'];
    }
        $this->imageValidation($this->filename,$this->filetype,$this->filesize);
    }

    public function imageValidation(String $filename, String $filetype,String $filesize)
    {
       $type = explode('/',$filetype);
       if($this->imageType($type[1]))
       {
        $image_name =  str_replace('.',"",microtime(TRUE));
        $image_name.=".";
        $image_name.=$type[1];
        $this->imageDetails['image_name'] = $image_name;
        $this->imageDetails['original_name']=$filename;
        $this->imageDetails['size'] =  $filesize; 
        $this->imageDetails['mime'] = $filetype;
       }
        

    }

    public function imageType(String $type)
    {
   
        $status = FALSE;
        
       
    if(in_array($type,$this->acceptedExtensions))
    {
        $status = TRUE;
    } 
    return $status; 
    }

    public function nameChange()
    {


    }

}
?>