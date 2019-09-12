<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_image_gallery` WHERE `student_image_gallery_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Image Gallery</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['image_gallery_id'])?'Edit Image Gallery':'Add Image Gallery';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddstudentimagegallery" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            
                            <div class="row">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Image*</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="image_gallery" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['image_gallery'])?$data['image_gallery']:''?>" required> >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div> 
                            </div>                              
                         
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "imageid" id="imageid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudentImageGallery">
                                    <input type="submit"  id="formvalidate" data-form="formaddimagegallery"  class="btn btn-info btn-md btn-submit"  value="Add Image">
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
