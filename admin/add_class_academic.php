<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT a.*,s.student_name,c.class_name FROM class_academic a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id join class_schedules c on a.schedule=c.class_schedules_id WHERE a.class_academic_id = '$id'"));
    }
 ?>
<section id="middle">
    
   
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
                                    <input type="text" placeholder = "Academic Name" class = "form-control" name = "class_academic_name" id = "class_academic_name" title = "Academic Name Required"  value="<?php echo isset($data['class_academic_name'])?$data['class_academic_name']:''?>"required>
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
                                    <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"  placeholder = "Start Date" class = "form-control" name = "start_date" id = "start_date" title = "Start Date Required"  value="<?php echo isset($data['start_date'])?date('d-m-Y',strtotime($data['start_date'])):'';?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Finish Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"  placeholder = "Finish Date" class = "form-control" name = "finish_date" id = "finish_date" title = "Finish Date Required"  value="<?php echo isset($data['finish_date'])?date('d-m-Y',strtotime($data['finish_date'])):'';?>"required>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Student Name *</label>
                                   
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" multiple id="student_app_id" name="student_app_id[]" required>
                                                <option value="">--Select--</option>
                                            <?php
                                                $student_list = array();
                                                if(isset($data['student_app_id'])){
                                                    if(strpos($data['student_app_id'], ',')){
                                                        $student_list = explode(',', $data['student_app_id']);
                                                    }else{
                                                        $student_list[] = $data['student_app_id'];
                                                    }
                                                }

                                                $selectpck = "SELECT * FROM school_application";
                                                $sql = mysqli_query($db, $selectpck);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                
                                                $str = $row['student_app_id'];
                                                if(strpos($str, ',')){
                                                    $str = "'".str_replace(",", "','", $str)."'";
                                                }
                                                else{
                                                    $str = "'".$str."'";
                                                }
                                                $sql002 = "SELECT * FROM school_application WHERE student_app_id IN ($str)";
                                                $query002 = mysqli_query($db,$sql002) or die(mysqli_error($db));
                                                $row002 = mysqli_fetch_assoc($query002,MYSQLI_ASSOC);                                              
                                                
                                                $student_name = array();
                                                foreach ($row002 as $key => $value) {
                                                    $student_name[] = $value['student_name'];
                                                }
                                                
                                                $student_name = implode(',',$student_name);
                                                $selected = (in_array($row['student_app_id'], $student_list))?'selected':'';
                                            ?>
                                                <option value="<?php echo $row['student_app_id']; ?>" <?=$student_name; ?> <?=$selected;?>><?php echo $row['student_name']; ?></option>>
                                            
                                            <?php }?> 
                                        </select>
                                     </div>   
                                </div>

								<div class="col-md-6 col-sm-6">

                                     <label>Teachers *</label>
                                   
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" multiple id="teacher_resource_assignment_id" name="teacher_resource_assignment_id[]" required>
                                                <option value="">--Select--</option>
                                            <?php
                                                $student_list = array();
                                                if(isset($data['teacher_resource_assignment_id'])){
                                                    if(strpos($data['teacher_resource_assignment_id'], ',')){
                                                        $student_list = explode(',', $data['teacher_resource_assignment_id']);
                                                    }else{
                                                        $student_list[] = $data['teacher_resource_assignment_id'];
                                                    }
                                                }

                                                $selectpck = "SELECT * FROM teacher_resource_assignment";
                                                $sql = mysqli_query($db, $selectpck);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                
                                                $str = $row['teacher_resource_assignment_id'];
                                                if(strpos($str, ',')){
                                                    $str = "'".str_replace(",", "','", $str)."'";
                                                }
                                                else{
                                                    $str = "'".$str."'";
                                                }
                                                $sql002 = "SELECT * FROM teacher_resource_assignment WHERE teacher_resource_assignment_id IN ($str)";
                                                $query002 = mysqli_query($db,$sql002) or die(mysqli_error($db));
                                                $row002 = mysqli_fetch_assoc($query002,MYSQLI_ASSOC);                                              
                                                
                                                $first_name = array();
                                                foreach ($row002 as $key => $value) {
                                                    $first_name[] = $value['first_name'];
                                                }
                                                
                                                $first_name = implode(',',$first_name);
                                                $selected = (in_array($row['teacher_resource_assignment_id'], $student_list))?'selected':'';
                                            ?>
                                                <option value="<?php echo $row['teacher_resource_assignment_id']; ?>" <?=$first_name; ?> <?=$selected;?>><?php echo $row['first_name'].' '.$row['last_name']; ?></option>>
                                            
                                            <?php }?> 
                                        </select>
                                        </div>
                                </div>
                            </div>


                            <div class="row">
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
                                
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Class Room</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="class_room_id" name="class_room_id">
                                                <option value="">--Select--</option>
                                            <?php
                                            $selectpck5 = "SELECT * FROM class_room";
                                                $sql5 = mysqli_query($db, $selectpck5);
                                            while ($row5 = mysqli_fetch_array($sql5)) {
                                                $selected5 = (isset($data['class_room_id']) && $row5['class_room_id'] == $data['class_room_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row5['class_room_id']; ?>" <?=$selected5; ?>><?php echo $row5['class_room_number']; ?></option>>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>   
                                </div> 
                            </div>




                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddClassAcademic">
                                        <input type="submit"  id="formvalidate" data-form="formclassaddacademic"  class="btn btn-info btn-md btn-submit"  value="<?php echo isset($id)?'Edit Academic':'Add Academic';?>">
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
