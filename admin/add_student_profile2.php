<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $student_app_id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_profile` WHERE `student_app_id` = '$student_app_id'"));
    }
    else{
        $student_app_id = '';
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student Profile</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['student_profile_id'])?'Edit Student Profile':'Add Student Profile';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddstudentprofile" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text"  placeholder = "First Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>" required>
                                </div>

                                <!-- <div class="col-md-4 col-sm-4">
                                    <label>Middle Name *</label>
                                    <input type="text"  placeholder = "Middle Name" class = "form-control" name = "middle_name" id = "middle_name" title = "Middle Name Required"  value="<?php //echo isset($data['middle_name'])?$data['middle_name']:''?>" required>
                                </div> -->
                           
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Last Name *</label>
                                    <input type="text"  placeholder = "Last Name" class = "form-control" name = "last_name" id = "last_name" title = "Last Name Required"  value="<?php echo isset($data['last_name'])?$data['last_name']:''?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Email *</label>									
									 <?php if(isset($data['std_email']) && !empty($data['std_email'])){?>
                                     <input type="email"  placeholder = "Email" class = "form-control" name = "email" id = "email" title = "Email Required"  value="<?php echo isset($data['std_email'])?$data['std_email']:''?>" readonly>
                                   <?php } else{?>
									
                                    <input type="email"  placeholder = "Email" class = "form-control" name = "email" id = "email" title = "Email Required"  value="" required>
								   <?php }?>
                                </div>
                           
                                <div class="col-md-6 col-sm-6">
                                    <label>Standard *</label>
                                    <input type="text"  placeholder = "Standard" class = "form-control" name = "standard" id = "standard" title = "Standard Required"  value="<?php echo isset($data['standard'])?$data['standard']:''?>" required>
                                </div>
                           
                               
                            </div>  

                            <div class="row">
							
							    <div class="col-md-6 col-sm-6 ">
                                    <label>Camp Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" multiple id="camp_management_id" name="camp_management_id[]">
                                            <option value="">--Select--</option>
                                            <?php

                                                $student_list = array();
                                                if(isset($data['camp_management_id'])){
                                                    if(strpos($data['camp_management_id'], ',')){
                                                        $student_list = explode(',', $data['camp_management_id']);
                                                    }else{
                                                        $student_list[] = $data['camp_management_id'];
                                                    }
                                                }

                                                $selectpck = "SELECT * FROM camp_management";
                                                $sql = mysqli_query($db, $selectpck);
                                            while ($row = mysqli_fetch_array($sql)) {
                                                $str = $row['camp_management_id'];
                                                if(strpos($str, ',')){
                                                    $str = "'".str_replace(",", "','", $str)."'";
                                                }
                                                else{
                                                    $str = "'".$str."'";
                                                }
                                                $sql002 = "SELECT * FROM camp_management WHERE camp_management_id IN ($str)";
                                                $query002 = mysqli_query($db,$sql002) or die(mysqli_error($db));
                                                $row002 = mysqli_fetch_assoc($query002,MYSQLI_ASSOC);
                                                $first_name = array();
                                                foreach ($row002 as $key => $value) {
                                                    $first_name[] = $value['camp_name'];
                                                }
                                                
                                                $first_name = implode(',',$first_name);
                                                $selected = (in_array($row['camp_management_id'], $student_list))?'selected':'';
                                            ?>
                                            <option value="<?php echo $row['camp_management_id']; ?>" <?=$selected; ?>><?php echo $row['camp_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Gender *</label><br>
                                    <?php //print_r($data['gender']);?>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="Male" id="gender" <?php if(isset($data['gender']) && $data['gender']=='Male'){ echo "checked"; } ?> required>Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="Female" id="gender" <?php if((isset($data['gender'])) && ($data['gender']=='Female')){ echo "checked"; } ?>>Female
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
                                        <input type="text"  placeholder = "Year" class = "form-control" name = "age_year" id = "age_year"  value="<?php echo isset($data['age_year'])?$data['age_year']:''?>"required>
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
                                    <textarea class="form-control" rows="5" name="address" id="address" required><?php echo isset($data['address'])?$data['address']:''?></textarea>
                                </div> 
                            </div> 

                            <div class="row">

                                <div class="col-md-6 col-sm-6 ">
                                <label>Boarding Room Number *</label>
                                <div class="fancy-form fancy-form-select">
                                <select class="form-control select2"  id="boarding_room_id" name="boarding_room_id">
                                        <option value="">--Select--</option>
                                    <?php
                                        $selectpck = "SELECT * FROM boarding_room";
                                        $sql = mysqli_query($db, $selectpck);
                                    while ($row = mysqli_fetch_array($sql)) {
                                        $selected = (isset($data['boarding_room_id']) && $row['boarding_room_id'] == $data['boarding_room_id'])?'selected':'';
                                    ?>
                                        <option value="<?php echo $row['boarding_room_id']; ?>" <?=$selected; ?>><?php echo $row['boarding_room_number']; ?></option>>
                                    
                                    <?php }?> 
                                    </select>
                                </div>
                                </div>

                            </div>
							
							<div class="row"> 
                                <div class="col-md-6 col-sm-6">
                                    <label>Picture*</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                      
										 <input type="file" class="form-control"  name="student_picture" onchange="jQuery(this).next('input').val(this.value);"   accept="image/jpeg, image/png" <?php echo isset($data['student_picture'])?'':'required';?>>
										
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""   required> 
                                        <span class="button">Choose File</span>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6 ">
                                    <?php if(isset($data['student_picture']) && !empty($data['student_picture'])){?>
                                    <div class="col-md-6"><img style="max-width: 100%;" src="<?php echo '../uploads/'.$data['student_picture']?>"><div class="clearfix"></div>
                                    </div>
                                <?php }?>
                                </div> 
                            </div>

                               

                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "studentid" id="studentid" value="<?php echo isset($data['student_profile_id']) && !empty($data['student_profile_id'])?$data['student_profile_id']:'';?>">
                                   <input type ="hidden" name = "student_app_id" id="student_app_id" value="<?php echo isset($student_app_id)?$student_app_id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudentProfile">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudentprofile"  class="btn btn-info btn-md btn-submit"  value="<?php echo isset($data['student_profile_id'])?'Edit Student':'Add Student';?>">
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
