<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_idcard` WHERE `student_idcard_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student ID Card</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['idcard_id'])?'Edit Student ID Card':'Add Student ID Card';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddstudentidcard" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Name *</label>
                                    <select class="form-control select2" id="student_idcard_details" name="student_app_id" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM school_application";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['student_app_id']) && $row['student_app_id'] == $data['student_app_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['student_app_id']; ?>" <?=$selected; ?>><?php echo $row['student_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <label>Student Type *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="student_type" name="student_type" required>
                                            <option value="">--Select--</option>
                                            <option value="day">Day Student</option>
                                            <option value="Boarding">Boarding Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Alergies</label>
                                    <input type="text"  placeholder = "Alergies" class = "form-control" name = "allergies" id = "allergies" title = "Alergies Required"  value="<?php echo isset($data['allergies'])?$data['allergies']:''?>" disabled>
                                </div>

                                <div class="col-md-6 col-sm-6 ">
                                    <label>CCA Group Number *</label>
                                    <input type="text"  placeholder = "CCA Group Number" class = "form-control" name = "cca_name" id = "cca_name" title = "CCA Group Number Required"  value="<?php echo isset($data['cca_name'])?$data['cca_name']:''?>" disabled>   
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Transport Pick Points *</label>
                                    <input type="text"  placeholder = "Transport Pick Points" class = "form-control" name = "student_pickup" id = "student_pickup" title = "Transport Pick Points Required"  value="<?php echo isset($data['student_pickup'])?$data['student_pickup']:''?>" disabled>

                                    <!-- <select class="form-control select2" id="idcard_pick_point" name="idcard_pick_point" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM student_profile";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['student_profile_id']) && $row['student_profile_id'] == $data['student_profile_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['student_profile_id']; ?>" <?=$selected; ?>><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select> -->

                                </div>
                            </div>
                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "idcardid" id="idcardid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudentIDCard">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudentidcard"  class="btn btn-info btn-md btn-submit"  value="Add Student ID Card">
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
