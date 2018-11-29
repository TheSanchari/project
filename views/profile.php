<?php
$user_id = $_SESSION['user_id'];
$logged_in = FALSE;
$logged_in = isset($user_id)??TRUE;

if(!$logged_in)
{
  header("location: index.php");
}


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
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}
div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
<section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Album</h1>
          <button type="button" class="btn btn-default btn-round-lg btn-lg" data-toggle="modal" data-target="#updateAlbum">Create Album</button>
          </p>
        </div>
      </section>
  <div class="col-md-4"></div>
  <div class="col-md-6">
  <form action="album.php" method="get">
            <?php
            
            if(isset($albums))
            {  
               if(!empty($albums))
        //        $user_id =  $_SESSION['user_id'];
        //        echo $user_id;
                {?> 
                     <?php 
                        foreach($albums as $album)
                        {

                        
                           
                           $album_name = $album['name'];
                           $album_description = $album['description'];
                           $album_id  = $album['id'];
                           $url = "gallery.php?";
                           $url .= "album_id";
                           $url .="={$album['id']}";
                          ?> 
                           <div class="col-xs-18 col-sm-6 col-md-3">
                            <div class="thumbnail">
                            <img src="images/<?= $album['last_image']['image_name'] ?>"class="img-responsive">
                                <div class="caption">
                                  <h4><?=$album_description?></h4>
                                  <p><?=$album_name?></p>
                                  <p><a href="<?=$url?>" class="btn btn-info btn-xs" role="button">View</a></p>
                              </div>
                            </div>
                          </div>
                        <?php
                       
                        }

                        
                                
                }

            }
            // echo $_SESSION['user_id'];
          ?>
            </form>
  </div>
  <div class="modal fade" id="updateAlbum" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Album</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
          <div class="form-group">
                           <label for="Name">Album Name</label>
                           <input type="text" class="form-control" id="name" name="name">
            
                </div>
                          
                           <div class="form-group">
                               <label for="my-input">Album description</label>
                               <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                           </div>
            
            
                     
                     <div class="form-group">
                              <button type="submit" class="btn btn-primary" name="album-submit">Create Album</button>      
                     </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
