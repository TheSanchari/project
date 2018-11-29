<?php
$user_id =  $_SESSION['user_id'];
$album_id = $_SESSION['album_id'];
$logged_in = FALSE;
$logged_in = isset($user_id)??TRUE;
if(!$logged_in)
{
    header("Location: index.php");
}
$caption = [];
$original_name = [];
$location = 'images/thumbnail/thumb_';
$location_original = 'images/'; 

?>
<style>

.btn-round-lg{
border-radius: 22.5px;
}
.btn-round{
border-radius: 17px;
}
.btn-round-sm{
border-radius: 15px;
}
.btn-round-xs{
border-radius: 11px;
padding-left: 10px;
padding-right: 10px;
}
.navbar {

    margin-bottom: 0px;
}

</style>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Image Gallery</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="profile.php">Album</a></li>
      <li><a href="GuestGallery.php">Guest Gallery</a></li>
      <li><a href="logout.php">Logout</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
</nav>
  <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Gallery</h1>
          <button type="button" class="btn btn-default btn-round-lg btn-lg" data-toggle="modal" data-target="#ImageUpload">Image Upload</button>
          <button type="button" class="btn btn-default btn-round-lg btn-lg" data-toggle="modal" data-target="#AlbumUpdate">Album Update</button>
          </p>
        </div>
      </section>

<div class="col-md-6 col-md-offset-3">


<div class="col-xs-12 col-sm-10">

<div class="row">
    <?php
        if(isset($images))
        {
            if(!empty($images))
            {
                foreach($images as $image)
                {
                    if($image['deleted_at']==NULL)                   
                    {?> 
                        <div class="col-xs-18 col-sm-6 col-md-3">
                                <div class="thumbnail" >
                                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                    <a href="<?=$location_original.$image['image_name']?>" data-fancybox data-caption="&lt;b&gt;Single photo&lt;/b&gt;&lt;br /&gt;Caption can contain &lt;em&gt;any&lt;/em&gt; HTML elements">
                                    <img src="<?=$location.$image['image_name']?>"class="img-responsive" alt="card-img-top">
                                    
                                    </a>
                                            <div class="caption">   
                                                <h4><?=$image['caption']?></h4>
                                                <p>Caption...</p>
                                                <input type="hidden" name="hidden-field" value="<?=$image['id']?>">
                                                <button type="submit" class="btn btn-info" name="delete-image">Delete</button>
                                                
                                        </div>
                                    </form>
                                    
                                </div>
                        </div>
    <?php
                    }
                }    
    ?>
      
      
</div><!-- /row -->

</div>
<?php
}
}



?>

</div>

<div class="modal fade" id="ImageUpload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
            <form  class="form-inline" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label class="btn btn-default btn-file">
                            upload Image <input type="file" style="display: none;"  name="album-image" id="album-image"> 
                    </label>
                </div>
                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" class="form-control" name="caption">
                </div>
                <div class="form-group">
                <select name="view_status" id="input" class="form-control">
                        <option value="">-- Privacy --</option>
                        <option value="1">public</option>
                        <option value="0">private</option>
                    </select>

                </div>
            <div class="form-group">
            <input type="submit" value="Save" name="image-upload">
            </div>
            </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AlbumUpdate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <div class="form-group">
                <label for="name">Album Name</label>
                <input id="name" class="form-control" type="text" name="name" value="<?=$album_details['name']?>">
            </div>
            <div class="form-group">
                <label for="description">Text</label>
                <input id="description" name="description"class="form-control" type="text" value="<?=$album_details['description']?>">
            </div>
            <div class="form-group">
            <input type="submit" value="Save" name="update-album">
            </div>
            </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php

?>




