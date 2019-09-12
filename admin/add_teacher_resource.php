<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `teacher_resource_assignment` WHERE `teacher_resource_assignment_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Teacher / Resource Assignment</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['teacher_resource_assignment_id'])?'Edit Teacher / Resource Assignment':'Add Teacher / Resource Assignment';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddteacherassignment" method="post" enctype="multipart/form-data">
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
                                    <label>Designation *</label>
                                    <input type="text"  placeholder = "Designation" class = "form-control" name = "designation" id = "designation" title = "Designation Required"  value="<?php echo isset($data['designation'])?$data['designation']:''?>"required>
                                </div>
                                  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Mobile Number *</label>
                                    <input type="text"  placeholder = "Mobile Number" class = "form-control" name = "mobile_number" id = "mobile_number" title = "Mobile Number Required"  value="<?php echo isset($data['mobile_number'])?$data['mobile_number']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    
									
									  <label>Email *</label>									
									 <?php if(isset($data['email_id']) && !empty($data['email_id'])){?>
                                     <input type="text"  placeholder = "Email Id" class = "form-control" name = "email_id" id = "email_id" title = "Email Id Required"  value="<?php echo isset($data['email_id'])?$data['email_id']:''?>" readonly>
                                   <?php } else{?>
									
                                   <input type="text"  placeholder = "Email Id" class = "form-control" name = "email_id" id = "email_id" title = "Email Id Required"  value=""required>
								   <?php }?>
                                   
                                </div>
                                  
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Address *</label>
                                    <input type="text"  placeholder = "Address" class = "form-control" name = "address" id = "address" title = "Address Required"  value="<?php echo isset($data['address'])?$data['address']:''?>"required>
                                </div>                               
                               
                            
                            </div>
							<div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Image *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png <?php echo isset($data['image'])?$data['image']:'required';?>">
                                        <input type="text" class="form-control" placeholder="No file selected" >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>                              
                                <div class="col-md-6 col-sm-6">
                                    <label>Resume/ Licence  *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="resume" onchange="jQuery(this).next('input').val(this.value);"  <?php echo isset($data['doc'])?'':'required';?>>
                                        <input type="text" class="form-control" placeholder="No file selected"   >
                                        <span class="button">Choose File</span>
										
                                    </div><i>Please upload pdf/doc file only</i>
                                </div>
                            
                            </div>
							
							<div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <?php if(isset($data['image']) && !empty($data['image'])){?>
                                    <div class="col-md-6"><img style="max-width: 100%;" src="<?php echo '../upload/'.$data['image']?>"><div class="clearfix"></div></div>
                                <?php }?>
                                </div>                              
                                <div class="col-md-6 col-sm-6">
                                   <div class="col-md-6 col-sm-6">
                                    <?php if(isset($data['doc']) && !empty($data['doc'])){?>
                                    <div class="col-md-6">
									 <a class="btn btn-xs btn-primary" target="_blank" href="../upload/<?php echo $data['doc'];?>" title="Document File"><i class="fa fa-eye"></i>View Document File</a>
									<div class="clearfix"></div></div>
                                <?php }?>
                                </div>
                                </div>
                            
                            </div>
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                       <input type ="hidden" name = "doc1" id="doc1" value="<?php echo isset($data['doc'])?$data['doc']:'';?>">
                                        <input type ="hidden" name = "type" value="AddTeacherAssignment">
                                        <input type="submit"  id="formvalidate" data-form="formaddteacherassignment"  class="btn btn-info btn-md btn-submit"  value="Add Teacher / Resource Assignment">
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
