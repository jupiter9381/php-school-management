<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `video_gellery` WHERE `video_gellery_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Videos</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit  Project':'Add Video';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddvideogellery" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Image *</label>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="video_gellery" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                            <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['video_gellery'])?$data['video_gellery']:''?>" required> 
                                            <span class="button">Choose Video</span>
                                        </div>
                                    </div>
                                <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "videogelleryid" id="videogelleryid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddVideoGellery">
                                        <input type="submit"  id="formvalidate" data-form="formaddvideogellery"  class="btn btn-info btn-md btn-submit"  value="Add Video ">
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
