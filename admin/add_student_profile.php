<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $student_app_id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT a.*,p.* FROM school_application a LEFT JOIN student_profile p ON a.student_app_id=p.student_app_id  WHERE a.student_app_id = '$student_app_id'"));
        
    }
    else{
        $student_app_id = '';
    }
 ?>

<section id="middle">
    
    <header id="page-header">
        <h1>Add Student Profile</h1>
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

                            <div id="page-wrap">        
                            

                            <!-- Pagination -->
                            <div id="panel-misc-portlet-r5" class="panel panel-default">

                                <div class="panel-heading responsible ">

                                    
                                    <ul class="pagination pagination-sm pull-center">
                                       
                                        <li class="active"><a href="#fragment-1"  data-toggle="tab" style="font-size: 11px;">Student Information </a></li>
                                        <li class=""><a href="#fragment-2"  data-toggle="tab" style="font-size: 11px;">Family </a></li>
                                        <li class="" ><a href="#fragment-3"  data-toggle="tab" style="font-size: 11px;">Transport</a></li>
                                        <li class="" ><a href="#fragment-4"  data-toggle="tab" style="font-size: 11px;">Academic  </a></li>
                                        <li class="" ><a href="#fragment-5"  data-toggle="tab" style="font-size: 11px;"> Health Record</a></li>
                                        <li class="" ><a href="#fragment-6"  data-toggle="tab" style="font-size: 11px;">Finance</a></li>
                                        <li class="" ><a href="#fragment-7"  data-toggle="tab" style="font-size: 11px;">Document </a></li>
                                    </ul>
                                    <!-- /right options -->

                                </div>

                               

                            </div>
                            <!-- /Pagination -->

                            
                            





                            <div class="tab-content transparent">



                            <div id="fragment-1" class="tab-pane active">
								<div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Student Id </label>
                                    <input type="text"  placeholder = "Student Id" class = "form-control" name = "student_id_number" id = "student_id_number" title = "Student ID "  value="<?php echo isset($data['student_id_number'])?$data['student_id_number']:''?>" >                                

                                </div>                                  
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Name (first/middle/last) *</label>
                                        <input type="text"  placeholder = "Student Name" class = "form-control" name = "student_name" id = "student_name" title = "Student Name Required"  value="<?php echo isset($data['student_name'])?$data['student_name']:''?>" >

                                        <!-- <select class="form-control select2" id="student_profile_details" name="student_profile_id" required>
                                            <option value="">--Select--</option>
                                            <?php
                                              //  $selectpck = "SELECT * FROM student_profile";
                                               // $sql = mysqli_query($db, $selectpck);
                                           // while ($row = mysqli_fetch_array($sql)) {
                                              //  $selected = (isset($data['student_profile_id']) && $row['student_profile_id'] == $data['student_profile_id'])?'selected':'';
                                            ?>
                                            <option value="<?php //echo $row['student_profile_id']; ?>" <?=$selected; ?>><?php //echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?></option>
                                            
                                            <?php //}?> 
                                        </select> -->

                                    </div>

                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Gender *</label><br>
                                        <label class="radio-inline">
                                          <input type="radio" name="gender" id="gender" value="Male" <?php if((isset($data['gender'])) && ($data['gender']=='Male')){ echo "checked"; } ?> >Male
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="gender" id="gender" value="Female" <?php if((isset($data['gender'])) && ($data['gender']=='Female')){ echo "checked"; } ?> >Female
                                        </label>
                                    </div>  
                                </div>

                                <div class="row">
                                    <?php //$birthday = DisplayDate($data['dob']); ?>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Date of Birth (DD/MM/YYYY) *</label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date of Birth" class = "form-control" name = "dob" id = "dob" title = "Date of Birth Required"  value="<?php echo isset($data['dob'])?date('d-m-Y',strtotime($data['dob'])):'';?>" >
                                    </div>

                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Age </label><br>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text"  placeholder = "Year" class = "form-control" name = "age_year" id = "age_year"  value="<?php echo isset($data['age_year'])?$data['age_year']:''?>" >
                                        </div>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text"  placeholder = "Month" class = "form-control" name = "age_month" id = "age_month" value="<?php echo isset($data['age_month'])?$data['age_month']:''?>" >
                                        </div>
                                    </div>  
                                </div> 

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Nationality *</label>
                                        <input type="text"  placeholder = "Nationality" class = "form-control" name = "nationality" id = "nationality" title = "Nationality Required"  value="<?php echo isset($data['nationality'])?$data['nationality']:''?>" >
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Grade *</label>
                                        <input type="text"  placeholder = " Grade" class = "form-control" name = "grade" id = "current_grade" title = "Current Grade Required"  value="<?php echo isset($data['grade'])?$data['grade']:''?>"  >
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Camp Enrolled  *</label>
                                        <input type="text"  placeholder = "Camp Enrolled" class = "form-control" name = "camp_enrolled" id = "camp_enrolled" title = "Camp Enrolled Required"  value="<?php echo isset($data['camp_enrolled'])?$data['camp_enrolled']:''?>">

                                    </div> 
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Student Type (Boarding/Day Student) *</label>
                                        
                                        <select class="form-control" name = "student_type" id = "student_type">
                                            
                                            <option>--Select--</option>
                                            <option value="Day" <?php  if(isset($data['student_type']) && $data['student_type']=='Day'){ echo 'selected'; } ?>>Day Student</option>
                                            <option value="Boarding" <?php  if(isset($data['student_type']) && $data['student_type']=='Boarding'){ echo 'selected'; } ?>>Boading Student</option>

                                        </select>
                                        
                                        <!--<input type="text" class="form-control"  placeholder = "Student Type (Boarding/Day Student)" name = "student_type" id = "student_type" title = "Student Type (Boarding/Day Student) Required" value="<?php //echo isset($data['student_type'])?$data['student_type']:''?>" >-->
                                    </div>  
                                     
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Academic Class (Assigned) *</label>
                                        <input type="text" class="form-control"   placeholder = "Academic Class (Assigned)" class = "form-control" name = "academic_class" id = "academic_class" title = "Academic Class (Assigned) Required"  value="<?php echo isset($data['academic_class'])?$data['academic_class']:''?>" >
                                        
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Boarding Allocation </label>
                                        <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="boarding_room_id" name="boarding_room_id">
                                                <option value="">--Select--</option>
                                            <?php
                                                $selectpck2 = "SELECT * FROM boarding_room";
                                                $sql2 = mysqli_query($db, $selectpck2);
                                            while ($row2 = mysqli_fetch_array($sql2)) {
                                                $selected2 = (isset($data['boarding_room_id']) && $row2['boarding_room_id'] == $data['boarding_room_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row2['boarding_room_id']; ?>" <?=$selected2; ?>><?php echo $row2['boarding_room_number']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                    </div> 
                                        
                                        
                                        <!--<input type="text"  placeholder = "Boarding Allocation" class = "form-control" name = "boarding_allocation" id = "boarding_allocation" title = "Boarding Allocation Required"  value="<?php //echo isset($data['boarding_allocation'])?$data['boarding_allocation']:''?>">-->
                                    </div>
                                     
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Transport Routes  </label>
                                        <input type="text" class="form-control"   placeholder = "Transport Routes" class = "form-control" name = "transport_routes" id = "transport_routes" title = "Transport Routes Required"  value="<?php echo isset($data['transport_routes'])?$data['transport_routes']:''?>" >
                                        
                                    </div>

                                    <div class="col-md-6 col-sm-6 ">
                                        <label>English Name *</label>
                                        <input type="text"  placeholder = "English Name" class = "form-control" name = "english_name" id = "english_name" title = "English Name Required"  value="<?php echo isset($data['english_name'])?$data['english_name']:''?>"  >
                                    </div>
                                     
                                </div>

                                <div class="row">
                                    
                                    <!-- <div class="col-md-6 col-sm-6 ">
                                        <label class="switch switch switch-round">Boarding Requested? &nbsp;
                                            <input type="checkbox" class="not_extra" name="boarding_req" value="1" <?php //if((isset($data['boarding_req'])) && ($data['boarding_req']=='1')){ echo "checked"; } ?> >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div> --> 
                                </div> 
                                <!-- <div class="tab-pane active" id="fragment-11">
                                    <a class="btn btn-primary btnNext" >Next</a>
                                </div> -->
                            </div>
                            <!-- Default switch -->
                            <div id="fragment-2" class="tab-pane">
                             
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does the applicant have siblings / family members attending camp RAS? &nbsp;
                                            <input type="checkbox" class="not_extra" name="siblings" id="siblings" value="1" <?php if((isset($data['siblings'])) && ($data['siblings']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                        
                                    </div>
                                </div> 

                                <div class="row campers_valid">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>If Yes, campers name (s) </label>
                                        <input type="text"  placeholder = "campers name" class = "form-control" name = "campers_name" id = "campers_name" title = "campers name Required"  value="<?php echo isset($data['campers_name'])?$data['campers_name']:''?>" >
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                            
                                    <label><h4 class="panel-title">FAMILY INFORMATION</h4></label>
                                    
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>Primary local address in Malaysia *</label>
                                        <textarea class="form-control" rows="5" name="address" id="address" ><?php echo isset($data['address'])?$data['address']:''?> </textarea>
                                    </div>
                                </div> 

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Parent 1 *</label>
                                        <input type="text"  placeholder = "Parent 1" class = "form-control" name = "mother_name" id = "mother_name" title = "Parent 1 Required"  value="<?php echo isset($data['mother_name'])?$data['mother_name']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Email (Parent 1) *</label>
                                        <input type="text"  placeholder = "Email Parent 1" class = "form-control" name = "mother_email" id = "mother_email" title = "Email Parent 1 Required"  value="<?php echo isset($data['mother_email'])?$data['mother_email']:''?>">
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Mobile (Parent 1) *</label>
                                        <input type="text"  placeholder = "Parent 1 Mobile" class = "form-control" name = "mother_mobile" id = "mother_mobile" title = "Parent 1 Mobile Required"  value="<?php echo isset($data['mother_mobile'])?$data['mother_mobile']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Home Phone Number: </label>
                                        <input type="text"  placeholder = "Home Phone Number" class = "form-control" name = "home_phone" id = "home_phone" title = "Home Phone Number Required"  value="<?php echo isset($data['home_phone'])?$data['home_phone']:''?>">
                                    </div>
                                </div>  

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Parent 2</label>
                                        <input type="text"  placeholder = "Parent 2" class = "form-control" name = "father_name" id = "father_name" title = "Parent 2 Required"  value="<?php echo isset($data['father_name'])?$data['father_name']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Email (Parent 2)</label>
                                        <input type="text"  placeholder = "Email Parent 2" class = "form-control" name = "father_email" id = "father_email" title = "Email Parent 2 Required"  value="<?php echo isset($data['father_email'])?$data['father_email']:''?>">
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Mobile (Parent 2) </label>
                                        <input type="text"  placeholder = "Parent 2 Mobile Number" class = "form-control" name = "father_mobile" id = "father_mobile" title = "Parent 2 Mobile Number Required"  value="<?php echo isset($data['father_mobile'])?$data['father_mobile']:''?>">
                                    </div>
                                </div> 

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>WeChat(if applicable) </label>
                                        <input type="text"  placeholder = "WeChat" class = "form-control" name = "wechat" id = "wechat" title = "WeChat Required"  value="<?php echo isset($data['wechat'])?$data['wechat']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Kakao Talk ID </label>
                                        <input type="text"  placeholder = "Kakao Talk" class = "form-control" name = "kakao_talk" id = "kakao_talk" title = "Kakao Talk Required"  value="<?php echo isset($data['kakao_talk'])?$data['kakao_talk']:''?>">
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Line ID</label>
                                        <input type="text"  placeholder = "Line ID" class = "form-control" name = "line_id" id = "line_id" title = "Line ID Required"  value="<?php echo isset($data['line_id'])?$data['line_id']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Whatsapp</label>
                                        <input type="text"  placeholder = "Whatsapp" class = "form-control" name = "whatsapp" id = "whatsapp" title = "Whatsapp Required"  value="<?php echo isset($data['whatsapp'])?$data['whatsapp']:''?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            
                                    <label><h4 class="panel-title">EMERGENCY CONTACT</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#emergency_contact" style="float: right;"></a><br>
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>In case parent / guardian cannot be reached, please provide local contact information (i.e. friend, colleague, relative)</label>
                                    </div>
                                </div> 

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Name</label>
                                        <input type="text"  placeholder = "Relative Name" class = "form-control" name = "relative_name" id = "relative_name" title = "Relative Name Required"  value="<?php echo isset($data['relative_name'])?$data['relative_name']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Relation to Student</label>
                                        <input type="text"  placeholder = "Relation to Student" class = "form-control" name = "relation_student" id = "relation_student" title = "Relation to Student Required"  value="<?php echo isset($data['relation_student'])?$data['relation_student']:''?>">
                                    </div>
                                </div> 

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Email</label>
                                        <input type="email"  placeholder = "Relative Email" class = "form-control" name = "relative_email" id = "relative_email" title = "Relative Name Required"  value="<?php echo isset($data['relative_email'])?$data['relative_email']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Phone Number</label>
                                        <input type="text"  placeholder = "Relative Phone Number" class = "form-control" name = "relative_phone" id = "relative_phone" title = "Relative Phone Number Required"  value="<?php echo isset($data['relative_phone'])?$data['relative_phone']:''?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                           
                                    <label><h4 class="panel-title">BOARDING ALLOCATION REQUEST</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#boarding_req" style="float: right;"></a><br>
                               

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label class="switch switch switch-round">Boarding Allocation Requested? &nbsp;
                                            <input type="checkbox" class="not_extra" name="boarding_allocation_req" value="1" <?php if((isset($data['boarding_allocation_req'])) && ($data['boarding_allocation_req']=='1')){ echo "checked"; } ?> >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>If the student applicant is boarding and would they like to be sharing a room with a friend or relative of a similar age and same gender,please add the students name</label>
                                    </div>
                                </div> 


                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Student Name</label>
                                        <input type="text"  placeholder = "Student Name" class = "form-control" name = "boarding_student_name" id = "boarding_student_name" title = "Boarding Student Required" value="<?php echo isset($data['boarding_student_name'])?$data['boarding_student_name']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                         <label>Gender *</label><br>
                                        <label class="radio-inline">
                                          <input type="radio" name="boarding_gender" value="male" <?php if((isset($data['boarding_gender'])) && ($data['boarding_gender']=='male')){ echo "checked"; } ?> >Male
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="boarding_gender" value="female" <?php if((isset($data['boarding_gender'])) && ($data['boarding_gender']=='female')){ echo "checked"; } ?> >Female
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Age</label>
                                        <input type="text"  placeholder = "Age" class = "form-control" name = "boarding_student_age" id = "boarding_student_age" title = "Boarding Age Required" value="<?php echo isset($data['boarding_student_age'])?$data['boarding_student_age']:''?>">
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" id="fragment-22">
                                    <a class="btn btn-primary btnPrevious" >Previous</a>
                                    <a class="btn btn-primary btnNext" >Next</a>
                                    
                                </div> -->
                                <!-- </div> --> 
                                <div class="clearfix"></div>
                            </div> 

                            <div id="fragment-4" class="tab-pane">
                                    <label><h4 class="panel-title">LANGUAGE ASSESSMENT</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#language_assessment" style="float: right;"></a><br>
                                

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Applicant’s most proficient language:</label>
                                        <input type="text"  placeholder = "Applicant’s most proficient language" class = "form-control" name = "proficient_language" id = "proficient_language" title = "Applicant’s most proficient language Required"  value="<?php echo isset($data['proficient_language'])?$data['proficient_language']:''?>" >
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Primary language at home:</label>
                                        <input type="text"  placeholder = "Primary language at home" class = "form-control" name = "primary_language_at_home" id = "primary_language_at_home" title = "Primary language at home Required"  value="<?php echo isset($data['primary_language_at_home'])?$data['primary_language_at_home']:''?>">
                                    </div>
                                </div> 
                                <div class="clearfix"></div>
                            <!-- </div> --> 



                            <!-- <div class="panel panel-default">
                                <div class="panel-heading"> -->
                                    <label><h4 class="panel-title">Parent’s assessment of applicant’s ability in English (please tick):</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#parent_assessment" style="float: right;"></a><br>
                                <!-- </div>
                            </div> -->

                            <!-- <div class="collapse" id="parent_assessment"> -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>*Please be aware that this is a camp specifically directed toward students with little, beginner, and intermediate English ability*</label>
                                    </div>
                                </div>
								<!-- change reading writing speaking -->
                                <div class="row">
                                     <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <!--<input type="checkbox" name="is_reading" value="1" <?php if((isset($data['is_reading'])) && ($data['is_reading']=='1')){ echo "checked"; } ?>>--><b>Reading :</b>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="reading_value" value="Sufficient" <?php if((isset($data['reading_value'])) && ($data['reading_value']=='Sufficient')){ echo "checked"; } ?>>&nbsp;Sufficient
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="reading_value" value="Intermediate" <?php if((isset($data['reading_value'])) && ($data['reading_value']=='Intermediate')){ echo "checked"; } ?>>&nbsp;Intermediate
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="reading_value" value="Beginner" <?php if((isset($data['reading_value'])) && ($data['reading_value']=='Beginner')){ echo "checked"; } ?>>&nbsp;Beginner
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="reading_value" value="None" <?php if((isset($data['reading_value'])) && ($data['reading_value']=='None')){ echo "checked"; } ?>>&nbsp;None
                                        </label>
                                    </div>   
                                </div> 

                                <div class="row">
                                     <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <!--<input type="checkbox" name="is_writing" value="1" <?php if((isset($data['is_writing'])) && ($data['is_writing']=='1')){ echo "checked"; } ?> >--><b>Writing :</b>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="writing_value" value="Sufficient" <?php if((isset($data['writing_value'])) && ($data['writing_value']=='Sufficient')){ echo "checked"; } ?>>&nbsp;Sufficient
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="writing_value" value="Intermediate" <?php if((isset($data['writing_value'])) && ($data['writing_value']=='Intermediate')){ echo "checked"; } ?> >&nbsp;Intermediate
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="writing_value" value="Beginner" <?php if((isset($data['writing_value'])) && ($data['writing_value']=='Beginner')){ echo "checked"; } ?> >&nbsp;Beginner
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="writing_value" value="None" <?php if((isset($data['writing_value'])) && ($data['writing_value']=='None')){ echo "checked"; } ?> >&nbsp;None
                                        </label>
                                    </div>   
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <!--<input type="checkbox" name="is_speaking" value="1" <?php if((isset($data['is_speaking'])) && ($data['is_speaking']=='1')){ echo "checked"; } ?> >--><b>Speaking :</b>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="speaking_value" value="Sufficient" <?php if((isset($data['speaking_value'])) && ($data['speaking_value']=='Sufficient')){ echo "checked"; } ?> >&nbsp;Sufficient
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="speaking_value" value="Intermediate" <?php if((isset($data['speaking_value'])) && ($data['speaking_value']=='Intermediate')){ echo "checked"; } ?> >&nbsp;Intermediate
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="speaking_value" value="Beginner" <?php if((isset($data['speaking_value'])) && ($data['speaking_value']=='Beginner')){ echo "checked"; } ?> >&nbsp;Beginner
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="speaking_value" value="None" <?php if((isset($data['speaking_value'])) && ($data['speaking_value']=='None')){ echo "checked"; } ?> >&nbsp;None
                                        </label>
                                    </div>   
                                </div>  
                                <div class="clearfix"></div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label><b>Learning Notes</b> </label>
                                        <textarea rows="5" placeholder = "Learning Notes" class = "form-control" name = "learning_notes" id = "learning_notes" title = "Applicant’s most proficient language Required"  value=""><?php echo isset($data['learning_notes'])?$data['learning_notes']:''?></textarea>
                                    </div>
                                    <!-- <div class="col-md-6 col-sm-6 ">
                                        <label>Primary language at home:</label>
                                        <input type="text"  placeholder = "Primary language at home" class = "form-control" name = "primary_language_at_home" id = "primary_language_at_home" title = "Primary language at home Required"  value="<?php //echo isset($data['primary_language_at_home'])?$data['primary_language_at_home']:''?>">
                                    </div> -->
                                </div>
                             
                                    <label><h4 class="panel-title">SUPPORT SERVICES</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#support_services" style="float: right;"></a><br>
                                <!-- </div>
                            </div> -->

                            <!-- <div class="collapse" id="support_services"> -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        
                                        <label class="switch switch switch-round">Are there any behavioral or learning support needs that we should be aware of? &nbsp;
                                            <input type="checkbox" class="support" id="support" name="support" value="1" <?php if((isset($data['support'])) && ($data['support']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>

                                    </div>
                                </div>

                                <div class="row support_needed">
                                    <div class="col-md-12 col-sm-12">
                                        <label>If Yes, please list the support needed.</label>
                                        <textarea class="form-control" rows="5" name="support_address" id="support_address" ><?php echo isset($data['support_address'])?$data['support_address']:''?></textarea>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" id="fragment-33">
                                    <a class="btn btn-primary btnPrevious" >Previous</a>
                                    <a class="btn btn-primary btnNext" >Next</a>
                                    
                                </div> -->
                            <!-- </div> -->
                                <div class="clearfix"></div>
                            </div>

                            <div id="fragment-3" class="tab-pane">

                           
                                    <label><h4 class="panel-title">TRANSPORTATION PLAN (Airport Transport) </h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#trasportation_plan" style="float: right;"></a><br>
                                <!-- </div>
                            </div> -->

                            <!-- <div class="collapse" id="trasportation_plan"> -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>Will the applicant and their family require transport to and from Senai or Changi Airport, before and after the camp?</label><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="transportation" value="Senai"  <?php if((isset($data['transportation'])) && ($data['transportation']=='Senai')){ echo "checked"; } ?> >Senai
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="transportation" value="Changi"  <?php if((isset($data['transportation'])) && ($data['transportation']=='Changi')){ echo "checked"; } ?> >Changi
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="transportation" value="No transport needed"  <?php if((isset($data['transportation'])) && ($data['transportation']=='No transport needed')){ echo "checked"; } ?> >No transport needed
                                        </label>
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>*If yes, please provide the relevant transport details to your agent or representative 4 weeks prior to the camp 1 start date. Failure to submit these documents on time will not guarantee the possibility of an airport pickup/drop-off. Please note that transport times may vary depending on availability.</label>
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>*Airport transfers from Changi are charged at an additional fee.</label>
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Flight Numbers (Arrive @ Start of Camp) *</label>
                                        <input type="text"  placeholder = "Flight Numbers (Arrive @ Start of Camp)" class = "form-control" name = "flight_numbers_arrive_start" id = "flight_numbers_arrive_start" title = "Flight Numbers (Arrive @ Start of Camp) Required"  value="<?php echo isset($data['flight_numbers_arrive_start'])?$data['flight_numbers_arrive_start']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Flight Arrive (Date) </label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Flight Arrive (Date)" class = "form-control" name = "flight_arrive_date" id = "flight_arrive_date" title = "Flight Arrive (Date) Required"  value="<?php echo isset($data['flight_arrive_date'])?$data['flight_arrive_date']:''?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Flight Arrive (Time)  </label>
                                        <input type="text"  placeholder = "Flight Arrive (Time) " class = "form-control timepicker" name = "flight_arrive_time" id = "flight_arrive_time" title = "Flight Arrive (Time) Required"  value="<?php echo isset($data['flight_arrive_time'])?$data['flight_arrive_time']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Flight Numbers (Depart @ End of Camp)</label>
                                        <input type="text"  placeholder = "Flight Numbers (Depart @ End of Camp)" class = "form-control" name = "flight_numbers_depart_end" id = "flight_numbers_depart_end" title = "Flight Numbers (Depart @ End of Camp) Required"  value="<?php echo isset($data['flight_numbers_depart_end'])?$data['flight_numbers_depart_end']:''?>">
                                    </div>
                                    <!-- <div class="col-md-6 col-sm-6 ">
                                        <label>Flight Arrive (date and time) </label>
                                        <input type="text"  placeholder = "Flight Arrive (date and time)" class = "form-control" name = "home_phone" id = "home_phone" title = "Home Phone Number Required"  value="<?php //echo isset($data['home_phone'])?$data['home_phone']:''?>">
                                    </div> -->
                                </div>



                           
                                <label><h4 class="panel-title">TRANSPORTATION PLAN FOR DAY STUDENTS</h4></label>
                                <a class="fa fa-plus" data-toggle="collapse" data-target="#trasportation_plan_student" style="float: right;"></a><br>
                              
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label><h4></h4></label><br>
                                        <label class="switch switch switch-round">Would you like to request transportation for your day student applicant? &nbsp;
                                        <input type="checkbox" class="not_extra" name="transport_student" value="1" <?php if((isset($data['transport_student'])) && ($data['transport_student']=='1')){ echo "checked"; } ?> >
                                        <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                        
                                        
                                    </div>
                                </div> 
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>Day student applicants requiring a daily pick up service, please tick one of the following pickup locations.</label><br>
                                        <div class="col-md-3 col-sm-3 ">
                                            <label class="checkbox-inline">
                                                <input type="radio" name="student_pickup" value="1" <?php if((isset($data['student_pickup'])) && ($data['student_pickup']=='1')){ echo "checked"; } ?> >Danga Bay (Starbucks)
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 ">
                                            <label class="checkbox-inline">
                                                <input type="radio" name="student_pickup" value="2" <?php if((isset($data['student_pickup'])) && ($data['student_pickup']=='2')){ echo "checked"; } ?> >Teega A (lobby)
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 ">
                                            <label class="checkbox-inline">
                                                <input type="radio" name="student_pickup" value="3" <?php if((isset($data['student_pickup'])) && ($data['student_pickup']=='3')){ echo "checked"; } ?> >Teega B (lobby)
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 ">
                                            <label class="checkbox-inline">
                                                <input type="radio" name="student_pickup" value="4" <?php if((isset($data['student_pickup'])) && ($data['student_pickup']=='4')){ echo "checked"; } ?> >Teega Suites (lobby)
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 ">
                                            <label class="checkbox-inline">
                                                <input type="radio" name="student_pickup" value="5" <?php if((isset($data['student_pickup'])) && ($data['student_pickup']=='5')){ echo "checked"; } ?> >Mall of medini(lobby) 
                                            </label>
                                        </div>
                                    </div>
                                </div> 

                                <label><h1 class="panel-title">AIRPORT ARRIVALS – TRANSPORTATION </h1></label>
                                    <!-- a class="fa fa-plus" data-toggle="collapse" data-target="#trasportation_plan_student" style="float: right;"></a> -->
                                    <br>
                                    <br>

                                <div class="row">

                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Arrival Date  </label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Arrival Date" class = "form-control" name = "arrival_date" id = "arrival_date" title = "Arrival Date Required"  value="<?php echo isset($data['arrival_date'])?$data['arrival_date']:''?>" >
                                    </div>

                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Arrival Time  </label>        
                                        <input type="text"  placeholder = "Arrival Time " class = "form-control timepicker " name = "arrival_time" id = "arrival_time"  value="<?php echo isset($data['arrival_time'])?$data['arrival_time']:''?>" >
                                    </div>  
                                </div>


                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Airport </label>
                                        <input type="text"  placeholder = "Airport " class = "form-control" name = "arrival_airport" id = "arrival_airport" title = "Airport Required"  value="<?php echo isset($data['arrival_airport'])?$data['arrival_airport']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Flight Number </label>
                                        <input type="text"  placeholder = "Flight Number " class = "form-control" name = "arrival_flight" id = "arrival_flight" title = "Flight Number Required"  value="<?php echo isset($data['arrival_flight'])?$data['arrival_flight']:''?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Drop Off Address  </label>
                                        <input type="text" placeholder = "Drop Off Address " class = "form-control" name = "drop_off_address" id = "drop_off_address" title = "Drop Off Address Required"  value="<?php echo isset($data['drop_off_address'])?$data['drop_off_address']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Total PAX </label>
                                        <input type="number"  placeholder = "Total PAX" class = "form-control" name = "arrival_total_pax" id = "arrival_total_pax" title = "Total PAX Required"  value="<?php echo isset($data['arrival_total_pax'])?$data['arrival_total_pax']:''?>">
                                    </div>
                                </div>




                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Luggage </label>
                                        <input type="text" placeholder = "Luggage" class = "form-control" name = "arrival_luggage" id = "arrival_luggage" title = "Luggage Required"  value="<?php echo isset($data['arrival_luggage'])?$data['arrival_luggage']:''?>">
                                    
                                </div>
                            </div>




                            <label><h1 class="panel-title">AIRPORT DEPARTURES  – TRANSPORTATION </h1></label>
                                    <!-- a class="fa fa-plus" data-toggle="collapse" data-target="#trasportation_plan_student" style="float: right;"></a> -->
                                    <br>
                                    <br>

                                <div class="row">

                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Departure Date   </label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Departure Date" class = "form-control" name = "departure_date" id = "departure_date" title = "Date of Birth Required"  value="<?php echo isset($data['departure_date'])?$data['departure_date']:''?>" >
                                    </div>

                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Departure Time </label>        
                                        <input type="text" placeholder = "Departure Time" class = "form-control timepicker " name = "departure_time" id = "departure_time"  value="<?php echo isset($data['departure_time'])?$data['departure_time']:''?>" >
                                    </div>  
                                </div>


                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Airport </label>
                                        <input type="text"  placeholder = "Airport " class = "form-control" name = "departure_airport" id = "departure_airport" title = "Airport Required"  value="<?php echo isset($data['departure_airport'])?$data['departure_airport']:''?>">
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Flight Number </label>
                                        <input type="text"  placeholder = "Flight Number " class = "form-control" name = "departure_flight" id = "departure_flight" title = "Relation to Student Required"  value="<?php echo isset($data['departure_flight'])?$data['departure_flight']:''?>">
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label> Pick up Address  </label>
                                        <input type="text" placeholder = "Pick up Address" class = "form-control" name = "pick_up_address" id = "pick_up_address" title = "Pick up Address Required"  value="<?php echo isset($data['pick_up_address'])?$data['pick_up_address']:''?>"></textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Total PAX  </label>
                                        <input type="number"  placeholder = "Total PAX" class = "form-control" name = "departure_total_pax" id = "departure_total_pax" title = "Total PAX Required"  value="<?php echo isset($data['departure_total_pax'])?$data['departure_total_pax']:''?>">
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Luggage </label>
                                        <input type="text" placeholder = "Luggage" class = "form-control" name = "departure_luggage" id = "departure_luggage" title = "Luggage Required"  value="<?php echo isset($data['departure_luggage'])?$data['departure_luggage']:''?>">
                                    
                                    </div>
                                </div>







                                <!-- <div class="tab-pane" id="fragment-44">
                                    <a class="btn btn-primary btnPrevious" >Previous</a>
                                    <a class="btn btn-primary btnNext" >Next</a>
                                    
                                </div> -->
                            <!-- </div> -->
                                <div class="clearfix"></div>
                            </div>
                            <div id="fragment-5" class="tab-pane">

                            
                                    <!-- <label><h4 class="panel-title">PARENTAL DISCLOSURE</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#parental_disclosure_head" style="float: right;"></a><br>
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="checkbox" name="parental_disclosure1" value="1" <?php if((isset($data['parental_disclosure1'])) && ($data['parental_disclosure1']=='1')){ echo "checked"; } ?> >&nbsp;I attest that the information provided above is accurate and complete, and understand that failure to fully disclose any and all of the above information may result in delayed / nullified acceptance of my child.
                                    </div>
                                </div>
                                <div class="clearfix"></div> 
                             </div> -->

                            <!-- <div class="panel panel-default">
                                <div class="panel-heading"> -->
                                    <!-- <label><h4 class="panel-title">ACKNOWLEDGEMENT</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#acknowledge_head" style="float: right;"></a><br>
                                 </div>
                            </div> -->

                            <!-- <div class="collapse" id="acknowledge_head"> -->
                               <!-- <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="checkbox" name="acknowledgement1" value="1" <?php if((isset($data['acknowledgement1'])) && ($data['acknowledgement1']=='1')){ echo "checked"; } ?> >&nbsp;I have read, understood and agreed to the Activity/Trip/Camp Consent Form as annexed together with this Application Form and the Brochure/Information of the Camp as annexed in Annexure A. This Application Form, the said Activity/Trip/Camp Consent Form and the said Brochure/Information of the Camp shall be taken together as constituting the entire contract between the parent(s) and the school.
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="checkbox" name="acknowledgement2" value="1" <?php if((isset($data['acknowledgement2'])) && ($data['acknowledgement2']=='1')){ echo "checked"; } ?> >&nbsp;I undertake and agree to pay the fee (amount invoiced by the school) on or before the time-lines provided by the school. I understand that all payments are non-refundable.
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Parent Signature:</label>
                                        
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Date</label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "ack_date1" id = "ack_date1" title = "Date Required"  value="<?php echo isset($data['ack_date1'])?$data['ack_date1']:''?>">
                                        
                                    </div>
                                </div> 

                                <div class="row">
                                     <div class="col-md-6 col-sm-6 ">
                                        <label>Parent Signature:</label>
                                        
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Date</label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "ack_date2" id = "ack_date2" title = "Date Required"  value="<?php echo isset($data['ack_date2'])?$data['ack_date2']:''?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                             </div> -->
                            
                                
                            <!-- <div class="panel panel-default">
                                <div class="panel-heading"> -->
                                    <label><h4 class="panel-title">STUDENT HEALTH RECORD</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#student_health_record" style="float: right;"></a><br>
                                <!-- </div>
                            </div> -->
                              
                            <!-- <div class="collapse" id="student_health_record"> -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label><h5>Please complete your child’s health record as accurately as possible.</h5></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does your child have any present illnesses? &nbsp;
                                            <input type="checkbox" class="not_extra" name="illnesses" id="illnesses" value="1" <?php if((isset($data['illnesses'])) && ($data['illnesses']=='1')){ echo "checked"; } ?> >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row illnesses_details">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>If yes, please provide details:</label>
                                        <textarea class="form-control" rows="5" name="illnesses_details" id="illnesses_details"  ><?php echo isset($data['illnesses_details'])?$data['illnesses_details']:''?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does your child suffer from any allergies? &nbsp;
                                            <input type="checkbox" class="not_extra" id="allergies" name="allergies" value="1" <?php if((isset($data['allergies_details'])) && ($data['allergies']=='1')){ echo "checked"; } ?>   >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row allergies_details">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>If yes please provide details of cause, effect, and whether your child takes any medication for it.</label>
                                        <textarea class="form-control" rows="5" name="allergies_details" id="allergies_details"  ><?php echo isset($data['allergies_details'])?$data['allergies_details']:''?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does your child experience any learning difficulties or mental impairments that we need to be aware of in order to cater for the needs of your child?&nbsp;
                                            <input type="checkbox" class="not_extra" name="mental_impairments" id="mental_impairments" value="1" <?php if((isset($data['mental_impairments'])) && ($data['mental_impairments']=='1')){ echo "checked"; } ?> >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row mental_impairments_details">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>(If yes) Please specify:</label>
                                        <textarea class="form-control" rows="5" name="mental_impairments_details" id="mental_impairments_details"  ><?php echo isset($data['mental_impairments_details'])?$data['mental_impairments_details']:''?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Has your child slept away from home for more than a week before?&nbsp;
                                            <input type="checkbox" class="not_extra" name="slept_away" value="1" <?php if((isset($data['slept_away'])) && ($data['slept_away']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>If your child has not slept away from home before, we strongly suggest they do so before the beginning of camp, as, for someyoung students, being away from home for extended periods can be quite traumatic.</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does your child have a history of asthma?&nbsp;
                                            <input type="checkbox" class="not_extra" name="asthma" value="1" <?php if((isset($data['asthma'])) && ($data['asthma']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does he / she carry an asthma inhaler?&nbsp;
                                            <input type="checkbox" class="not_extra" name="inhaler" value="1" <?php if((isset($data['inhaler'])) && ($data['inhaler']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does your child wear glasses or contact lenses?&nbsp;
                                            <input type="checkbox" class="not_extra" name="lenses" value="1" <?php if((isset($data['lenses'])) && ($data['lenses']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Does your child have trouble hearing or use a hearing aid?&nbsp;
                                            <input type="checkbox" class="not_extra" name="hearing" value="1" <?php if((isset($data['hearing'])) && ($data['hearing']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Is your child on daily medication?&nbsp;
                                            <input type="checkbox" class="not_extra" name="daily_medication" value="1" <?php if((isset($data['daily_medication'])) && ($data['daily_medication']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 col-sm-8 ">
                                        <label class="switch switch switch-round">Please list the name of the medications and the time / frequency required:
                                        </label>
                                    </div>
                                    <div class="col-md-4 col-sm-4" style="margin-left: -163px;margin-top: -10px;">
                                        <input type="text"  placeholder = "Medication list" class = "form-control" name = "medication_list" id = "medication_list" title = "Mother Name Required"  value="<?php echo isset($data['medication_list'])?$data['medication_list']:''?>"  >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label>Is there any health condition or any limitations on your child’s physical activity that the school should be aware of?</label>
                                        <textarea class="form-control" rows="5" name="health_condition_details" id="health_condition_details"  ><?php echo isset($data['health_condition_details'])?$data['health_condition_details']:''?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="switch switch switch-round">Can your child swim?&nbsp;
                                            <input type="checkbox" class="not_extra" name="child_swim" value="1" <?php if((isset($data['child_swim'])) && ($data['child_swim']=='1')){ echo "checked"; } ?>  >
                                            <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        </label>
                                    </div>
                                </div>

                                <!--<div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="checkbox" name="attest_info" value="1" <?php if((isset($data['attest_info'])) && ($data['attest_info']=='1')){ echo "checked"; } ?>  >&nbsp;I attest that all the above information is accurate.
                                    </div>
                                </div>-->

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="checkbox" name="give_permission" value="1" <?php if((isset($data['give_permission'])) && ($data['give_permission']=='1')){ echo "checked"; } ?>  >&nbsp;I hereby give permission to the school to administer the following medications to my child if deemed necessary by the school nurse:<br>
                                        <label>Tylenol – Panadol – Ibuprofen – Aspirin – Antacid – Sudafed</label><br>
                                        <!--<label>(Please cr oss out (x) any medication NOT to be given to your child)</label>-->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="checkbox" name="give_permission_emergency" value="1" <?php if((isset($data['give_permission_emergency'])) && ($data['give_permission_emergency']=='1')){ echo "checked"; } ?>  >&nbsp;I hereby give permission for emergency measures to be initiated in case of accident or sudden illness with the understanding that I will be notified.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="checkbox" name="permission_medical_staff" value="1" <?php if((isset($data['permission_medical_staff'])) && ($data['permission_medical_staff']=='1')){ echo "checked"; } ?>  >&nbsp;I hereby give permission to the RAS Medical staff to administer medication that is prescribed to my child.
                                    </div>
                                </div>


                                
                                <div class="clearfix"></div>
                            </div>

                           
                                    <!-- <label><h4 class="panel-title">OTHERS</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#others_head" style="float: right;"></a><br>
                                 </div>
                            </div> -->

                            <!-- <div class="collapse" id="others_head"> --> 

                               <!-- <div class="row">
                                     <div class="col-md-2 col-sm-2">
                                        <label>To:</label> 
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" class="form-control" name="to_head" id="to_head" value="Raffles American School" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-2 col-sm-2">
                                        <label>Date:</label> 
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                         <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date Head" name = "date_head" id = "date_head" title = "Date Head Required"  value="<?php echo isset($data['date_head'])?$data['date_head']:''?>">
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-2 col-sm-2">
                                        <label>Camp Name:</label> 
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" placeholder="Camp Name" class="form-control" name="activity_camp" id="activity_camp" value="<?php echo isset($data['activity_camp'])?$data['activity_camp']:''?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>This letter is to give permission for my/our child to participate in the activity/trip/camp. I/We acknowledgethat my/our child is expected to abide by RAS school rules and conform to RAS teachers/staff instructionsat all times to ensure a safe activity/trip/camp both within and beyond the school vicinity.</label>
                                        <ol>
                                            <li>I/We have read all of the information contained in this letter in relation to the activity/trip/camp(including any attached material). I/We hereby freely and voluntarily give consent for my/our child <input type="text" class="form-control" name="info_other_letter" id="info_other_letter" value="<?php echo isset($data['info_other_letter'])?$data['info_other_letter']:''?>"> 
                                                with passport number : 
                                            <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name = "info_other_date1" id = "info_other_date1" title = "Date Head Required"  value="<?php echo isset($data['info_other_date1'])?$data['info_other_date1']:''?>">

                                             To participate in the RafflesAmerican School Camp on 

                                             <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name = "info_other_date2" id = "info_other_date2" title = "Date Head Required"  value="<?php echo isset($data['info_other_date2'])?$data['info_other_date2']:''?>"> (Date)
                                            </li>

                                            <li>In the event of an accident or illness, I/we authorise RAS staff to obtain or administer any medicalassistance or treatment that my/our child may reasonably require, including contacting my/ourchild’s doctor.</li>

                                            <li>I/We accept liability for all reasonable costs incurred by RAS in obtaining such medical assistanceor treatment (including any transportation costs) and undertake to reimburse RAS the full amountof those costs.</li>

                                            <li>I/We have provided RAS all relevant details of my/our child’s medical or physical needs to RAS.I/We further declare and confirm that my/our child’s medical and physical condition is suitable to participate in the activity/trip/camp.</li>

                                            <li>I/We further understand, acknowledge and agree that at any time RAS reserves the right to accept or decline participation to my/our child, if in the judgment of RAS my/our child is causing unreasonable disturbance or danger to himself/herself or any other students, participants or RAS.</li>

                                            <li>I/We give consent to RAS to store and process the Personal Data provided in this letter for the purpose as described in this letter and to disclose the Personal Data to the relevant governmental authorities or third parties where required by law or for legal purposes. For avoidance of doubt,Personal Data includes all data defined in the Personal Data Protection Act 2010 including all data I/We have disclosed to RAS in this letter.</li>

                                            <li>I/We acknowledge and understand that while every reasonable and practical precaution and care will be taken by RAS, participation in the activity/trip/camp may carry with it certain risks which cannot be eliminated. These elements of risk also contribute to the sense of adventure and fun experienced by students which RAS considers as important to the social development of students.</li>

                                            <li>I/We understand and acknowledge that RAS, its elected officials and officers, employees, agents, volunteers and representatives cannot accept responsibility for force majeure events over which it/they have no control, such as acts of God, strikes or government restrictions, and terrorist activities.</li>

                                            <li>I/We acknowledge and accept all of the inherent risks associated with my/our child’s participation in the activity/trip/camp and the possibility of personal injury, death, property damage or loss arising therefrom and agree to assume all the risks whether foreseen or unforeseen and waive all and any of my/our rights, claims, demands or actions whatsoever that I/we may have now or in the future against RAS, its elected officials and officers, employees, agents, volunteers and/or representatives in connection with the activity/trip/camp.</li>

                                            <li>In consideration of my/our child being allowed to voluntarily participate in the activity/trip/camp with its inherent risks and hazards, I/we agree to hold harmless, release and indemnify against RAS, its directors, employees, agents, volunteers and/or representatives from and against any and all liabilities, claims, demands, causes of action, costs, expenses whatsoever in respect to injury, death, loss or damage to my/our child or any person or property directly or indirectly arising out of my/our child’s participation in the activity/trip/camp unless caused by proven negligence of RAS.</li>

                                            <li>I/We shall also indemnify and keep indemnified at all times fully and effectively against RAS, its directors, employees, agents, volunteers and/or representatives any act, deed, matter or thing done or omitted by RAS pursuant to any directions or instructions given by me/us to RAS.</li>

                                            <li>I/We acknowledge that due to safety and security reasons, my/our child is not permitted to change room allocations after final applications have been submitted (only applicable to boarding students).</li>

                                            <li>I/We understand and agree that RAS shall make the final decision for my/our child's placement in a class deemed suitable for both their age and English levels based on RAS testing procedures.</li>
                                        </ol>
                                       
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>This letter including all clauses stated above shall be construed according to the laws of Malaysia. In theevent of conflict between the English and Chinese language, the English version of this letter shall prevail.</label> 
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-3 col-sm-3">
                                        <label>Signature of Student/Participant:</label>
                                        
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label>Date:</label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date Student/Participant" name = "other_sign_student_date1" id = "other_sign_student_date1" title = "Date Student/Participant Required"  value="<?php echo isset($data['other_sign_student_date1'])?$data['other_sign_student_date1']:''?>">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label>Signature of Parent:</label>
                                        
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label>Date</label>
                                        <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date Parent" name = "other_sign_student_date2" id = "other_sign_student_date2" title = "Date Parent Required"  value="<?php echo isset($data['other_sign_student_date2'])?$data['other_sign_student_date2']:''?>">
                                    </div>
                                </div> 

                                <div class="row">
                                     <div class="col-md-6 col-sm-6">
                                        <label>Student/Participant Name:</label>
                                        <input type="text"  placeholder = "Student/Participant Name" class = "form-control" name = "student_participant_name" id = "student_participant_name" title = "Student/Participant Name Required"  value="<?php echo isset($data['student_participant_name'])?$data['student_participant_name']:''?>">
         
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Parent/Guardian Name:</label>
                                        <input type="text"  placeholder = "Parent/Guardian Name " class = "form-control" name = "parent_guardian_name" id = "parent_guardian_name" title = "Parent/Guardian Name Required"  value="<?php echo isset($data['parent_guardian_name'])?$data['parent_guardian_name']:''?>">
                                        
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-6 col-sm-6">
                                        <label>Signature of Witness Student/Participant:</label>
         
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Signature of Witness Parent/Guardian:</label>
                                        
                                    </div>
                                </div> -->
                            <!-- </div> -->

                                <!-- <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label>Emergency Contact Number:</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                         <input type="text" class="form-control" name="emergency_contact_number" id="emergency_contact_number" value="<?php //echo isset($data['emergency_contact_number'])?$data['emergency_contact_number']:''?>">
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <label>Phone:</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                         <input type="text" class="form-control" name="emergency_phone_number" id="emergency_phone_number" value="<?php //echo isset($data['emergency_phone_number'])?$data['emergency_phone_number']:''?>">
                                    </div>
                                </div> -->


                                <div class="clearfix"></div> 
                            <!-- </div> -->

                            <!-- <div class="panel panel-default">
                                <div class="panel-heading"> -->
                                    <!-- <label><h4 class="panel-title">FOR OFFICE USE ONLY</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#office_use" style="float: right;"></a><br>
                             

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Please feel free to contact our Executive Coordinator, Ian Nenke at inenke@rafflesamericanschool.org ifyou have any questions or concerns.</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Acknowledged by,</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label>Name:</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" class="form-control" name="office_name" id="office_name" value="<?php echo isset($data['office_name'])?$data['office_name']:''?>">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label>Designation:</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" class="form-control" name="office_designation" id="office_designation" value="<?php echo isset($data['office_designation'])?$data['office_designation']:''?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label>Date:</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                         <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  name = "office_date" id = "office_date" title = "Date Required"  value="<?php echo isset($data['office_date'])?$data['office_date']:''?>" >
                                    </div>
                                </div>

                                <div class="clearfix"></div> --> 
                            
                                    <!-- <label><h4 class="panel-title">APPENDIX</h4></label>
                                    <a class="fa fa-plus" data-toggle="collapse" data-target="#appendix" style="float: right;"></a><br> -->
                                <!-- </div>
                            </div> -->

                            <!-- <div class="collapse" id="appendix"> -->
                                <!-- <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h4>RISKS:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Possible risks or injuries included in the activity/trip/camp may include but not limited to:</label>
                                        <ol type="a">
                                            <li>Risk of injury inherent in playing any type of sports or recreational activities;</li>

                                            <li>Exposure to outdoors, nature, weather, Acts of God, sea life, insects/animal or plant life;</li>

                                            <li>Inexperience or unfamiliarity with the activity or its requirements;</li>

                                            <li>Unfamiliarity with location or facility;</li>

                                            <li>Faulty equipment/gear or inadequate instruction;</li>

                                            <li>Complications or reaction from weather conditions or outside environment or nature;</li>

                                            <li>Inadequate or unavailable healthcare facilities or assistance;</li>

                                            <li>Other accidents, loss of life, illnesses, allergic reactions (food, plants, insects etc), negligenceand/or mistake.</li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h4>PRECAUTIONS:</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Recommended precautions including but not limited to:</label>
                                        <ol type="a">
                                            <li>Check local weather before departure and be familiar with the activities involved.</li>

                                            <li>Bring appropriate clothing, footwear, supplies, protective gear (sports related, sunglasses,sunscreen, hat, etc) suitable for outdoor or recreational activities, standing/walking etc.</li>

                                            <li>Avoid bringing valuables or keep them secure at all times. RAS shall not responsible for any lost or stolen items.</li>

                                            <li>Advise RAS prior to any activity of any existing medical conditions or injury of the student.</li>

                                            <li>Bring any necessary medications or emergency/medical kits (ie bee sting kits/epi-pen, inhalers,etc).</li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                             </div> -->

                            <!--<div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Passport Copy *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="passport_copy" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['passport_copy'])?$data['passport_copy']:''?>" > 
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <label>Travel Insurance *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="travel_insurance" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['travel_insurance'])?$data['travel_insurance']:''?>" > 
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group">
                                    <?php if(isset($data['passport_copy']) && $data['passport_copy']!='') { ?>
                                    <div class="col-md-6 col-sm-6">
                                        <img src="<?php echo "../uploads/".$data['passport_copy']; ?>" alt="Passport Copy" height="100px" width="100px">
                                        <input type="hidden" name="passport_copy" value="<?php echo $data['passport_copy'];?>" >
                                    </div>
                                    <?php } ?>

                                    <?php if(isset($data['travel_insurance']) && $data['travel_insurance']!='') { ?>
                                    <div class="col-md-6 col-sm-6">
                                        <img src="<?php echo "../uploads/".$data['travel_insurance']; ?>" alt="Travel Insurance" height="100px" width="100px">
                                        <input type="hidden" name="travel_insurance" value="<?php echo $data['travel_insurance'];?>" >
                                    </div>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        


                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Photo *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="student_photo" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['student_photo'])?$data['student_photo']:''?>" > 
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                            </div>-->

                            <!-- <div class="tab-pane" id="fragment-55">
                                    <a class="btn btn-primary btnPrevious" >Previous</a>
                                </div> -->

                            <!--<div class="row">
                                <div class="form-group">
                                    <?php if(isset($data['student_photo']) && $data['student_photo']!='') { ?>
                                    <div class="col-md-6 col-sm-6">
                                        <img src="<?php echo "../uploads/".$data['student_photo']; ?>" alt="Student Photo" height="100px" width="100px">
                                        <input type="hidden" name="student_photo" value="<?php echo $data['student_photo'];?>" >
                                    </div>
                                </div>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div> -->

                             <div id="fragment-6" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Deposit of MYR 2,000*</label>
                                        <input type="text"  placeholder = "Deposit of MYR" class = "form-control" name = "deposite" id = "deposite" title = "Student Name Required"  value="<?php echo isset($data['deposite'])?$data['deposite']:''?>" >


                                    </div>

                                    <div class="col-md-6 col-sm-6 ">
                                        <label> Receipt No. *</label><br>
                                        <input type="text"  placeholder = "Receipt No." class = "form-control" name = "receipt" id = "receipt" title = "Student Name Required"  value="<?php echo isset($data['receipt'])?$data['receipt']:''?>" >
                                    </div>  
                                </div>

                                 <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>  Total Received *</label><br>
                                        <input type="text"  placeholder = " Total Received" class = "form-control" name = "total_received" id = "total_received" title = "Student Name Required"  value="<?php echo isset($data['total_received'])?$data['total_received']:''?>" >
                                    </div>  
                                    <div class="col-md-6 col-sm-6 ">
                                        <label> Total Camp Fee*</label>
                                        <input type="text"  placeholder = " Total Camp Fee" class = "form-control" name = "camp_fee" id = "camp_fee" title = "Student Name Required"  value="<?php echo isset($data['camp_fee'])?$data['camp_fee']:''?>" >


                                    </div>
  
                                </div>
                                 <div class="row">

                                    <div class="col-md-6 col-sm-6 ">
                                        <label> Balance Due *</label><br>
                                        <input type="text"  placeholder = "Balance Due  " class = "form-control" name = "bal_bue" id = "bal_bue" title = "Student Name Required"  value="<?php echo isset($data['bal_bue'])?$data['bal_bue']:''?>" >
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>Early Bird Discount*</label>
                                        <input type="text"  placeholder = "Early Bird Discount" class = "form-control" name = "early_bird_dis" id = "early_bird_dis" title = "Student Name Required"  value="<?php echo isset($data['early_bird_dis'])?$data['early_bird_dis']:''?>" >


                                    </div>

                                     
                                </div>
                                 <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label> Discount 5% *</label><br>
                                        <input type="text"  placeholder = " Discount 5%" class = "form-control" name = "discount" id = "discount" title = "Student Name Required"  value="<?php echo isset($data['discount'])?$data['discount']:''?>" >
                                    </div> 
                                    <div class="col-md-6 col-sm-6 ">

                                        <label> Payment Type</label>
                                        <input type="text"  placeholder = " Payment Type" class = "form-control" name = "payment_type" id = "payment_type" title = "Student Name Required"  value="<?php echo isset($data['payment_type'])?$data['payment_type']:''?>" >


                                    </div>

                                </div>

                             
                            </div>
                            <div id="fragment-7" class="tab-pane">


                                <?php
                            $i=0;

                            $q1 = mysqli_query($db,"SELECT * FROM `student_profile` WHERE student_app_id= $student_app_id");
                                while($r1 = mysqli_fetch_assoc($q1)) 
                               {             
                                // print_r($r1);
                            $i++;      
                
                                ?>


                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        
                                        <label>Passport Copy</label><br>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="passport_copy" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'pdf'">
                                            <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['passport_copy'])?$data['passport_copy']:''?>" > 
                                            <span class="button">Choose File</span>
                                        </div>
                                        <?php if($r1['passport_copy'] != ''){ ?>
                                        <td><a href="../uploads/<?php echo $r1['passport_copy'];?>"   ><i class="fa fa-eye"> View</i> </a></td>
                                        <?php } ?>&nbsp;&nbsp;
                                        <?php if($r1['passport_copy'] != ''){ ?>
                                        <td><a href="../uploads/<?php echo $r1['passport_copy'];?>"  download ><i class="fa fa-download"> Download</i> </a></td>
                                        <?php } ?>


                                    </div>

                                    <div class="col-md-6 col-sm-6 ">
                                        <label> Travel Insurance</label><br>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="travel_insurance" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'pdf'">
                                            <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['travel_insurance'])?$data['travel_insurance']:''?>" > 
                                            <span class="button">Choose File</span>
                                        </div>
                                        <?php if($r1['travel_insurance'] != ''){ ?>
                                        <td><a href="../uploads/<?php echo $r1['travel_insurance'];?>" ><i class="fa fa-eye"> View</i> </a></td>
                                        &nbsp;&nbsp;
                                        <td><a href="../uploads/<?php echo $r1['travel_insurance'];?>" download ><i class="fa fa-download"> Download</i> </a></td>
                                        <?php } ?>
                                    </div>  
                                </div>

                                 <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <label>  Student Photo</label><br>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="student_photo" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                            <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['student_photo'])?$data['student_photo']:''?>" > 
                                            <span class="button">Choose File</span>
                                        </div>
                                        <?php if($r1['student_photo'] != ''){ ?>
                                        <td><a href="../uploads/<?php echo $r1['student_photo'];?>"  ><i class="fa fa-eye"> View</i> </a></td>
                                        &nbsp;&nbsp;
                                        
                                        <td><a href="../uploads/<?php echo $r1['student_photo'];?>" download ><i class="fa fa-download"> Download</i> </a></td>
                                        <?php } ?>
                                    </div>  
                                    <div class="col-md-6 col-sm-6 ">                                      
                                        <label>Final Application File</label><br>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="final_application_form" onchange="jQuery(this).next('input').val(this.value);" accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'pdf'">
                                            <input type="text" class="form-control" placeholder="No file selected" readonly="" value="<?php echo isset($data['final_application_form'])?$data['final_application_form']:''?>"  required> >
                                            <span class="button">Choose File</span>
                                        </div>
                                         <?php if(!empty($r1['final_application_form'])){ ?>
                                        <td><a href="../uploads/<?php echo $r1['final_application_form'];?>" ><i class="fa fa-eye"> View</i> </a></td>
                                        &nbsp;&nbsp;
                                        
                                        <td><a href="../uploads/<?php echo $r1['final_application_form'];?>" download ><i class="fa fa-download"> Download</i> </a></td>
                                        <?php } ?>
                                    </div>  
                                </div> 
                                 <?php }?>  
                            </div>
                            
                        </div>
                        </div>
                        </div>
                        </div>
                       
                    </fieldset>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 text-center">
                               <!-- <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>"> -->
                                <input type ="hidden" name = "type" value="AddStudentProfile">
                                <input type ="hidden" name = "student_app_id" value="<?=$student_app_id;?>">
                                <input type="submit"  id="formvalidate" data-form="formaddproject"  class="btn btn-info btn-md btn-submit"  value="Update Student">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</section>

<?php include("footer.php"); ?>



<script>
        $(window).load(function(){
            
            $("[name='sub_event[event_start_date]']").datepicker({
                todayBtn:  1,
                autoclose: true,
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                console.log(minDate);
                $("[name='sub_event[event_end_date]']").datepicker('setStartDate', minDate);
            });
            
            $("[name='sub_event[event_end_date]']").datepicker()
                .on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    
                    $("[name='sub_event[event_start_date]']").datepicker('setEndDate', minDate);
                });
        });
</script>


<script>
$('.btnNext').click(function(){
    //console.log('Hi');
    $('.pagination-sm > .active').next('li').find('a').trigger('click');
});

$('.btnPrevious').click(function(){
    $('.pagination-sm > .active').prev('li').find('a').trigger('click');
});
</script>
