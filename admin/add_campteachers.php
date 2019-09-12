<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `camp_teacher` WHERE `camp_teacher_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Camp Teachers</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['camp_teacher_id'])?'Edit CampTeacher':'Add Camp Teachers';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddcampteacher" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>First Name *</label>
                                    <input type="text"  placeholder = "First Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>last Name *</label>
                                    <input type="text"  placeholder = "last Name" class = "form-control" name = "last_name" id = "last_name" title = "last Name Required"  value="<?php echo isset($data['last_name'])?$data['last_name']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Id Number *</label>
                                    <input type="text"  placeholder = "Id Number" class = "form-control" name = "id_number" id = "id_number" title = "Id Number Required"  value="<?php echo isset($data['id_number'])?$data['id_number']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Mobile Number *</label>
                                    <input type="text"  placeholder = "Mobile Number" class = "form-control" name = "mobile_number" id = "mobile_number" title = "Mobile Number Required"  value="<?php echo isset($data['mobile_number'])?$data['mobile_number']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Email Id *</label>
                                    <input type="text"  placeholder = "Email Id" class = "form-control" name = "email_id" id = "email_id" title = "Email Id Required"  value="<?php echo isset($data['email_id'])?$data['email_id']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Address *</label>
                                    <textarea rows="5"  placeholder = "Address" class = "form-control" name = "address" id = "address" title = "Address Required" value="" required><?php echo isset($data['address'])?$data['address']:''?></textarea>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Image *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly="" value="<?php echo isset($data['image'])?$data['image']:''?>" required> >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddCampTeacher">
                                        <input type="submit"  id="formvalidate" data-form="formaddcampteacher"  class="btn btn-info btn-md btn-submit"  value="Add Camp Teacher">
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
