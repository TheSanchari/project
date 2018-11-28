<?php
$location = 'images/thumbnail/thumb_';
$location_original = 'images/';
if(isset($results))
{
    if(!empty($results))
    {  
        foreach($results as $image)
        {  
            
            $image_name[] = $image['image_name'];
        }
     
    }
}
?>
<style>
.list-group {
    padding-left: 0;
    margin-bottom: 0px;
}
</style>
 <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Guest Gallery</h1>
          </p>
        </div>
      </section>
<div class="col-md-6 col-md-offset-3">	
     
	        <div class="row">
                <?php
                if(isset($results)&&!empty($results))
                {
                    foreach($results as $result)
                    {
                        if(empty($result['deleted_at']))
                        {
                    
                  
                ?> 
                            <div class='list-group gallery'>
                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="<?=$location_original.$result['image_name']?>">
                                            <img class="img-responsive" alt="" src="<?=$location.$result['image_name']?>" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Uploaded At<?=$result['created_at']?></small>
                                            </div> <!-- text-right / end -->
                                        </a>
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
?>
</div>
<script>
$(document).ready(function(){
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
   
</script>