<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `cca` WHERE `cca_id` = '$id'"));
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Class Assignments </h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['cca_id'])?'Edit  ClassAssignments ':'Add  Class Assignments';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddclassassignments" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                <label>Number of  Students in Camps  *</label>
                                    <input type="text"  placeholder = "Number of  Students in Camps" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Attendance Records *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png">
                                    <input type="text" class="form-control" placeholder="No file selected" readonly="" >
                                    <span class="button">Choose File</span>
                                </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                <label>Roll Call Documents *</label>
                                <div class="fancy-file-upload fancy-file-primary">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png">
                                    <input type="text" class="form-control" placeholder="No file selected" readonly="" >
                                    <span class="button">Choose File</span>
                                </div>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                <label>Reports *</label>
                                <div class="fancy-file-upload fancy-file-primary">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png">
                                    <input type="text" class="form-control" placeholder="No file selected" readonly="" >
                                    <span class="button">Choose File</span>
                                </div>
                                </div>
                                  
                            </div>                         
                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Add Class Assignments">
                                        <input type="submit"  id="formvalidate" data-form="formaddclassassignments"  class="btn btn-info btn-md btn-submit" value="Add Class Assignments">
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
