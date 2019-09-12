<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `class_academic` WHERE `class_academic_id` = '$id'"));
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Academic</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['academic_id'])?'Edit Academic':'Add Academic';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formclassaddacademic" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Academic Name *</label>
                                    <input type="text"  placeholder = "Academic Name" class = "form-control" name = "class_academic_name" id = "class_academic_name" title = "Academic Name Required"  value="<?php echo isset($data['class_academic_name'])?$data['class_academic_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Class Schedule *</label>
                                    <input type="text"  placeholder = "Class Schedule" class = "form-control" name = "schedule" id = "schedule" title = "Mobile Number Required"  value="<?php echo isset($data['schedule'])?$data['schedule']:''?>"required>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Start Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"  placeholder = "Start Date" class = "form-control" name = "start_date" id = "start_date" title = "Start Date Required"  value="<?php echo isset($data['start_date'])?$data['start_date']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Finish Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"  placeholder = "Finish Date" class = "form-control" name = "finish_date" id = "finish_date" title = "Finish Date Required"  value="<?php echo isset($data['finish_date'])?$data['finish_date']:''?>"required>
                                </div> 
                            </div> 

                            <?php

                            

                            ?>
                            

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Student Name *</label>
                                   
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" multiple id="student_profile_id" name="student_profile_id[]" required>
                                                <option value="">--Select--</option>
                                            <?php
                                                $student_list = array();
                                                if(isset($data['student_profile_id'])){
                                                    if(strpos($data['student_profile_id'], ',')){
                                                        $student_list = explode(',', $data['student_profile_id']);
                                                    }else{
                                                        $student_list[] = $data['student_profile_id'];
                                                    }
                                                }

                                                $selectpck = "SELECT * FROM student_profile";
                                                $sql = mysqli_query($db, $selectpck);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                
                                                $str = $row['student_profile_id'];
                                                if(strpos($str, ',')){
                                                    $str = "'".str_replace(",", "','", $str)."'";
                                                }
                                                else{
                                                    $str = "'".$str."'";
                                                }
                                                $sql002 = "SELECT * FROM student_profile WHERE student_profile_id IN ($str)";
                                                $query002 = mysqli_query($db,$sql002) or die(mysqli_error($db));
                                                $row002 = mysqli_fetch_all($query002,MYSQLI_ASSOC);
                                                $first_name = array();
                                                foreach ($row002 as $key => $value) {
                                                    $first_name[] = $value['first_name'];
                                                }
                                                
                                                $first_name = implode(',',$first_name);
                                                $selected = (in_array($row['student_profile_id'], $student_list))?'selected':'';
                                            ?>
                                                <option value="<?php echo $row['student_profile_id']; ?>" <?=$first_name; ?> <?=$selected;?>><?php echo $row['first_name']; ?></option>>
                                            
                                            <?php }?> 
                                        </select>
                                     </div>   
                                </div>

                                <div class="col-md-6 col-sm-6 ">
                                    <label>Camp Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="camp_management_id" name="camp_management_id">
                                                <option value="">--Select--</option>
                                            <?php
                                                $selectpck2 = "SELECT * FROM camp_management";
                                                $sql2 = mysqli_query($db, $selectpck2);
                                            while ($row2 = mysqli_fetch_array($sql2)) {
                                                $selected2 = (isset($data['camp_management_id']) && $row2['camp_management_id'] == $data['camp_management_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row2['camp_management_id']; ?>" <?=$selected2; ?>><?php echo $row2['camp_name']; ?></option>>
                                            
                                            <?php }?> 
                                        </select>
                                     </div>   
                                </div>
                                  
                            </div>  

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Teacher Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="camp_teacher_id" name="camp_teacher_id" required>
                                                <option value="">--Select--</option>
                                            <?php
                                                $selectpck3 = "SELECT * FROM camp_teacher";
                                                $sql3 = mysqli_query($db, $selectpck3);
                                            while ($row3 = mysqli_fetch_array($sql3)) {
                                                $selected3 = (isset($data['camp_teacher_id']) && $row3['camp_teacher_id'] == $data['camp_teacher_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row3['camp_teacher_id']; ?>" <?=$selected3; ?>><?php echo $row3['first_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                     </div>   
                                </div>

                                <div class="col-md-6 col-sm-6 ">
                                    <label>School Staff</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="school_staff_id" name="school_staff_id">
                                                <option value="">--Select--</option>
                                            <?php
                                                $selectpck4 = "SELECT * FROM school_staff";
                                                $sql4 = mysqli_query($db, $selectpck4);
                                            while ($row4 = mysqli_fetch_array($sql4)) {
                                                $selected4 = (isset($data['school_staff_id']) && $row4['school_staff_id'] == $data['school_staff_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row4['school_staff_id']; ?>" <?=$selected4; ?>><?php echo $row4['first_name']; ?></option>>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>   
                                </div> 
                            </div>                       
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddClassAcademic">
                                        <input type="submit"  id="formvalidate" data-form="formclassaddacademic"  class="btn btn-info btn-md btn-submit"  value="Add Academic">
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
