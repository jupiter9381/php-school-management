<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT a.*,p.first_name,p.middle_name,p.last_name,p.standard FROM student_attendance a LEFT JOIN student_profile p ON a.student_profile_id=p.student_profile_id WHERE `student_attendance_id` = '$id'"));

    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student Attendance</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['attendance_id'])?'Edit Student Attendance':'Add Student Attendance';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddattendance" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Name *</label>
                                    <select class="form-control select2" id="student_attendance" name="student_profile_id" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM student_profile";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['student_profile_id']) && $row['student_profile_id'] == $data['student_profile_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['student_profile_id']; ?>" <?=$selected; ?>><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                </div>
                           
                                 <div class="col-md-6 col-sm-6 ">
                                    <label>Roll Number*</label>
                                    <input type="text"  placeholder = "Roll Number" class = "form-control" name = "roll_number" id = "roll_number" title = "Roll Number Required"  value="<?php echo isset($data['roll_number'])?$data['roll_number']:''?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Standard *</label>
                                    <input type="text"  placeholder = "Standard" class = "form-control" name = "standard" id = "standard" title = "Standard Required"  value="<?php echo isset($data['standard'])?$data['standard']:''?>" disabled>
                                </div>
                           
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "atted_date" id = "atted_date" title = "Date Required"  value="<?php echo isset($data['atted_date'])?date('d-m-Y',strtotime($data['atted_date'])):'';?>" required>
                                </div>
                            </div>                            

                            <div class="row"> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Present/Absent *</label>
                                    <input type="text"  placeholder = "Present/Absent" class = "form-control" name = "present_absent" id = "present_absent" title = "Present/Absent Required"  value="<?php echo isset($data['present_absent'])?$data['present_absent']:''?>"required>
                                </div>

                                <div class="col-md-6 col-sm-6 ">
                                    <label>Class List *</label>
                                    <input type="text"  placeholder = "Class List" class = "form-control" name = "class_list" id = "class_list" title = "Class List Required"  value="<?php echo isset($data['class_list'])?$data['class_list']:''?>"required>
                                </div> 
                               
                            </div>
                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "attendanceid" id="attendanceid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudentAttendance">
                                    <input type="submit"  id="formvalidate" data-form="formaddattendance"  class="btn btn-info btn-md btn-submit"  value="Add Student Attendance">
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


