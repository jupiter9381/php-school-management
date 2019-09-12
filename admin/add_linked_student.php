<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `linked_student` WHERE `linked_student_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Linked Student Profile</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Linked Student Profile':'Add Linked Student Profile';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddlinkedstudent" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text"  placeholder = "First Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>" required>
                                </div>
                           
                                 <div class="col-md-6 col-sm-6 ">
                                    <label>Last Name *</label>
                                    <input type="text"  placeholder = "Last Name" class = "form-control" name = "last_name" id = "last_name" title = "Last Name Required"  value="<?php echo isset($data['last_name'])?$data['last_name']:''?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Contact Number *</label>
                                    <input type="text"  placeholder = "Standard" class = "form-control" name = "contact_number" id = "contact_number" title = "Standard Required"  value="<?php echo isset($data['contact_number'])?$data['contact_number']:''?>" required>
                                </div>
                           
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Roll Number *</label>
                                    <input type="text"  placeholder = "Roll Number" class = "form-control" name = "roll_number" id = "roll_number" title = "Roll Number Required"  value="<?php echo isset($data['roll_number'])?$data['roll_number']:''?>" required>
                                </div>
                            </div>  

                            <div class="row">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Picture*</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['picture'])?$data['picture']:''?>" required> >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Gender *</label><br>
                                    <label class="radio-inline">
                                      <input type="radio" name="gender" checked>Male
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="gender">Female
                                    </label>
                                </div> 
                               
                            </div>                              
                        
                            <div class="row"> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Nationality *</label>
                                    <input type="text"  placeholder = "Nationality" class = "form-control" name = "nationality" id = "nationality" title = "Nationality Required"  value="<?php echo isset($data['nationality'])?$data['nationality']:''?>"required>
                                </div> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Age </label><br>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text"  placeholder = "Year" class = "form-control" name = "age_year" id = "age_year"  value="<?php echo isset($data['age_year'])?$data['age_year']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text"  placeholder = "Month" class = "form-control" name = "age_month" id = "age_month" value="<?php echo isset($data['age_month'])?$data['age_month']:''?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row"> 
                                 <div class="col-md-6 col-sm-6 ">
                                    <label>Grade *</label>
                                    <input type="text"  placeholder = "Grade" class = "form-control" name = "grade" id = "grade" title = "Grade Required"  value="<?php echo isset($data['grade'])?$data['grade']:''?>"required>
                                </div> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Address *</label>
                                    <textarea class="form-control" rows="5" name="address" id="address"><?php echo isset($data['address'])?$data['address']:''?></textarea>
                                </div> 
                            </div>

                            <div class="row"> 
                                 <div class="col-md-6 col-sm-6 ">
                                    <label>Agent *</label>
                                    <select class="form-control select2" id="agent_name" name="agent_name">
                                            <option value="">--Select--</option>
                                             <?php
                                                $selectpck = "SELECT * FROM agent_profile";
                                                $sql = mysqli_query($db, $selectpck);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                $selected = (isset($data['linked_student_id']) && $row['agent_profile_id'] == $data['linked_student_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row['agent_name']; ?>" <?=$selected; ?>><?php echo $row['agent_name']; ?></option>
                                            
                                            <?php }?> 
                                    </select>
                                    
                                </div> 
                            </div>
                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "linkedstudentid" id="linkedstudentid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddLinkedStudent">
                                    <input type="submit"  id="formvalidate" data-form="formaddlinkedstudent"  class="btn btn-info btn-md btn-submit"  value="Add Linked Student">
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
