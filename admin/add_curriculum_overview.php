<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `curriculum_overview` WHERE `curriculum_overview_id` = '$id'"));
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Curriculum Overview for Academic Class </h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['curriculum_overview_id'])?'Edit Curriculum Overview':'Add Curriculum Overview for Academic Class';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddcurriculumoverview" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Curriculum Overview Name *</label>
                                    <input type="text"  placeholder = "Curriculum Overview Name" class = "form-control" name = "    curriculum_overview_name" id = "    curriculum_overview_name" title = "Curriculum Overview Required"  value="<?php echo isset($data['curriculum_overview_name'])?$data['curriculum_overview_name']:''?>"required>
                                </div>
                                   <div class="col-md-6 col-sm-6">
                                    <label>Documents *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly="" value="<?php echo isset($data['documents'])?$data['documents']:''?>" required>
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>  
                            </div>
                                             
                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddCurriculumOverview">
                                        <input type="submit"  id="formvalidate" data-form="formaddcurriculumoverview"  class="btn btn-info btn-md btn-submit"  value="Add Curriculum Overview">
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
