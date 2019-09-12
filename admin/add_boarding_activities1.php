<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT t1.*,t2.class_name FROM `boarding_activities` as t1 join class_schedules as t2 on t1.schedule=t2.class_schedules_id WHERE t1.boarding_activities_id = '$id'"));
    }
 ?>
<section id="middle">
    
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['boarding_activities_id'])?'Edit Boarding Activities ':'Add Boarding Activities';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddboardingactivities" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Boarding Activities Name *</label>
                                    <input type="text"  placeholder = "Boarding Activities Name" class = "form-control" name = "boarding_activities_name" id = "boarding_activities_name" title = "Boarding Activities Name Required"  value="<?php echo isset($data['boarding_activities_name'])?$data['boarding_activities_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Class Schedule *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="schedule" name="schedule">
                                        <option value="<?php echo isset($id)?$data['schedule']:''?>"><?php echo isset($id)?$data['class_name']:'-Select-'?></option>
                                        <?php                                      
                                        $sql = mysqli_query($db,"SELECT * FROM class_schedules");
                                        while ($r1 = mysqli_fetch_array($sql)) {                                            
                                        ?>
                                        <option value="<?php echo $r1['class_schedules_id']; ?>" ><?php echo $r1['class_name']; ?></option>
                                        
                                        <?php }?> 
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Start Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Start Date" class = "form-control" name = "start_date" id = "start_date" title = "Start Date Required" value="<?php echo isset($data['start_date'])?date('d-m-Y',strtotime($data['start_date'])):'';?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Finish Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Finish Date" class = "form-control" name = "finish_date" id = "finish_date" title = "Finish Date Required"  value="<?php echo isset($data['finish_date'])?date('d-m-Y',strtotime($data['finish_date'])):'';?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                <label>Student Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" multiple id="student_app_id" name="student_app_id[]">
                                                <option value="<?php echo isset($id)?$data['student_app_id']:''?>">--Select--</option>
                                            <?php

                                                $student_list = array();
                                                if(isset($data['student_add_id'])){
                                                    if(strpos($data['student_add_id'], ',')){
                                                        $student_list = explode(',', $data['student_add_id']);
                                                    }else{
                                                        $student_list[] = $data['student_add_id'];
                                                    }
                                                }

                                                $selectpck = "SELECT * FROM school_application";
                                                $sql = mysqli_query($db, $selectpck);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                 $str = $row['student_add_id'];
                                                    if(strpos($str, ',')){
                                                        $str = "'".str_replace(",", "','", $str)."'";
                                                    }
                                                    else{
                                                        $str = "'".$str."'";
                                                    }
                                                    $sql002 = "SELECT * FROM school_application WHERE student_add_id IN ($str)";
                                                    $query002 = mysqli_query($db,$sql002) or die(mysqli_error($db));
                                                    $row002 = mysqli_fetch_assoc($query002,MYSQLI_ASSOC);
                                                    $first_name = array();
                                                    foreach ($row002 as $key => $value) {
                                                        $first_name[] = $value['student_name'];
                                                    }
                                                    
                                                    $first_name = implode(',',$first_name);
                                                    $selected = (in_array($row['student_app_id'], $student_list))?'selected':'';
                                            ?>
                                                <option value="<?php echo $row['student_app_id']; ?>" <?=$selected; ?>><?php echo $row['student_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Teachers*</label>
                                    <select name="teachers_id[]" id="teachers_id" multiple  required="" class=" form-control select2">
                                        <option value="<?php echo isset($id)?$data['teachers_id']:''?>"></option>
                                    <?php 

                                        $teacher_list = array();
                                        if(isset($data['teachers_id'])){
                                            if(strpos($data['teachers_id'], ',')){
                                                $teacher_list = explode(',', $data['teachers_id']);
                                            }else{
                                                $teacher_list[] = $data['teachers_id'];
                                            }
                                        }

                                        $q4=mysqli_query($db,"select * from teacher_resource_assignment order by first_name asc");
                                        while($r1=mysqli_fetch_assoc($q4))
                                        {

                                            $str1 = $r1['teacher_resource_assignment_id'];
                                            if(strpos($str1, ',')){
                                                $str1 = "'".str_replace(",", "','", $str1)."'";
                                            }
                                            else{
                                                $str1 = "'".$str1."'";
                                            }
                                            $sql0022 = "SELECT * FROM teacher_resource_assignment WHERE teacher_resource_assignment_id IN ($str1)";
                                            $query0022 = mysqli_query($db,$sql0022) or die(mysqli_error($db));
                                            $row0022 = mysqli_fetch_assoc($query0022,MYSQLI_ASSOC);
                                            $first_name1 = array();
                                            foreach ($row0022 as $key1 => $value1) {
                                                $first_name1[] = $value1['first_name'];
                                            }
                                            
                                            $first_name1 = implode(',',$first_name1);
                                            $selected = (in_array($r1['teacher_resource_assignment_id'], $teacher_list))?'selected':'';


                                            $teacher=$r1["first_name"].' '.$r1["last_name"];
                                        ?>
                                        <option value="<?php echo $r1["teacher_resource_assignment_id"];?>" <?=$selected; ?>><?php echo $teacher;?></option>
                                    <?php } ?>
                                    </select>
                                </div> 
                            </div>                         
                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddBoardingActivities">
                                        <input type="submit"  id="formvalidate" data-form="formaddboardingactivities"  class="btn btn-info btn-md btn-submit" value="<?php echo isset($id)?'Edit Boarding Activities':'Add Boarding Activities'?>">
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
