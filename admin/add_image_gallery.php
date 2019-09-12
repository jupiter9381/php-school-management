<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `image_gallery` WHERE `image_gallery_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Images</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit  Project':'Add Images';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formimagegallery" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">                           
                           

                                    <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Image *</label>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="gallery_image" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'" required>
                                            <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['gallery_image'])?$data['gallery_image']:''?>" required> 
                                            <span class="button">Choose Image</span>
                                        </div>
                                    </div>
                                <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "imagegalleryid" id="imagegalleryid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddImageGallery">
                                        <input type="submit"  id="formvalidate" data-form="formimagegallery"  class="btn btn-info btn-md btn-submit"  value="Add Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
</section>
<?php include("footer.php"); ?>
