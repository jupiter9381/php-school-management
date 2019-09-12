<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT a.*,s.first_name,c.class_name FROM class_academic a LEFT JOIN student_profile s ON a.student_profile_id=s.student_profile_id join class_schedules c on a.schedule=c.class_schedules_id WHERE a.class_academic_id = '$id'"));
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
                                    <input type="text"  placeholder = "Academic Name" class = "form-control" name = "class_academic_name" id = "class_academic_name" title = "Academic Name Required"  value="<?php echo isset($data['class_academic_name'])?$data['class_academic_name']:''?>"required>
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
                                    <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"  placeholder = "Start Date" class = "form-control" name = "start_date" id = "start_date" title = "Start Date Required"  value="<?php echo isset($data['start_date'])?$data['start_date']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Finish Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"  placeholder = "Finish Date" class = "form-control" name = "finish_date" id = "finish_date" title = "Finish Date Required"  value="<?php echo isset($data['finish_date'])?$data['finish_date']:''?>"required>
                                </div> 
                            </div> 
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
								<div class="col-md-6 col-sm-6">
                                 <label>Teachers*</label>
                                <select name="teachers_id[]" id="teachers_id" multiple  required="" class=" form-control multiselect">
								
								<?php 
								$q4=mysqli_query($db,"select *from teacher_resource_assignment order by first_name asc");
								while($r1=mysqli_fetch_assoc($q4))
								{
									$teacher=$r1["first_name"].' '.$r1["last_name"];
								?>
								<option value="<?php echo $r1["teacher_resource_assignment_id"];?>"><?php echo $teacher;?></option>
								<?php } ?>
                                </select>
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
