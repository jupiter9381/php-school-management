<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `project` WHERE `project_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Transport – Vehicles and Drivers </h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit  Project':'Add Transport – Vehicles and Drivers ';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddproject" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>First Name *</label>
                                    <input type="text"  placeholder = "First Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>last Name *</label>
                                    <input type="text"  placeholder = "last Name" class = "form-control" name = "last_name" id = "last_name" title = "last Name Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Id Number *</label>
                                    <input type="text"  placeholder = "Id Number" class = "form-control" name = "id_number" id = "id_number" title = "Id Number Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Mobile Number *</label>
                                    <input type="text"  placeholder = "Mobile Number" class = "form-control" name = "mobile_number" id = "mobile_number" title = "Mobile Number Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Email Id *</label>
                                    <input type="text"  placeholder = "Email Id" class = "form-control" name = "email_id" id = "email_id" title = "Email Id Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Address *</label>
                                    <input type="text"  placeholder = "Address" class = "form-control" name = "address" id = "address" title = "Address Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Vehicle Number *</label>
                                    <input type="text"  placeholder = "Vehicle Number" class = "form-control" name = "vehicle number" id = "vehicle number" title = "Vehicle Number Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Image *</label>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="image" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                            <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['project_des'])?$data['project_file']:''?>" required> 
                                            <span class="button">Choose File</span>
                                </div>  
                            </div>

                                    <!-- <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Image *</label>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="image" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                            <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php //echo isset($data['project_des'])?$data['project_file']:''?>" required> 
                                            <span class="button">Choose File</span>
                                        </div>
                                    </div> -->
                                <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "applicationid" id="applicationid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddApplication">
                                        <input type="submit"  id="formvalidate" data-form="formaddproject"  class="btn btn-info btn-md btn-submit"  value="Add Transport">
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
