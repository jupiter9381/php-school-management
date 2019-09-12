<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `enrollment_status` WHERE `enrollment_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Enrollment Status</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Enrollment Status':'Add Enrollment Status';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddenrollmentstatus" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-6 col-sm-6">
                                    <label>Student Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                    <select class="form-control select2"  id="student_profile_report" name="student_app_id">
                                        <option value="">--Select--</option>
                                    <?php
                                        $selectpck = "SELECT * FROM school_application";
                                        $sql = mysqli_query($db, $selectpck);
                                    while ($row = mysqli_fetch_array($sql)) {
                                        $selected = (isset($data['student_app_id']) && $row['student_app_id'] == $data['student_app_id'])?'selected':'';
                                    ?>
                                    <option value="<?php echo $row['student_app_id']; ?>" <?=$selected; ?>><?php echo $row['student_name']; ?></option>>
                                    
                                    <?php }?> 
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Value *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="enrollment_value" name="enrollment_value">
                                            <option value="">--Select--</option>
                                            <option value="yes" <?php if($data['enrollment_value'] =="yes"){echo "selected";}?>>YES</option>
                                            <option value="no" <?php if($data['enrollment_value'] =="no"){echo "selected";}?>>NO</option>
                                            <option value="unsure" <?php if($data['enrollment_value'] =="unsure"){echo "selected";}?>>UNSURE</option>
                                            <!-- <option value="<?php echo isset($data['enrollment_value'])?$data['enrollment_value']:''?>"></option> -->
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Enrollment Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "enrollment_date" id = "enrollment_date" title = "Date Required"  value="<?php echo isset($data['enrollment_date'])?date('d-m-Y',strtotime($data['enrollment_date'])):'';?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Enrollment Notes *</label>
                                    <textarea rows="5" class="form-control" name="enrollment_notes" id="enrollment_notes"> <?php echo isset($data['enrollment_notes'])?$data['enrollment_notes']:''?></textarea>
                                </div>
                            </div> 

                           <!--  <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Value *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="enrollment_value" name="enrollment_value">
                                            <option value="">--Select--</option>
                                            <option value="yes">YES</option>
                                            <option value="no">NO</option>
                                            <option value="unsure">UNSURE</option>
                                        </select>
                                    </div>
                                </div>
                                    
                                </div> -->
                            </div>                      
                           
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "enrollmenttid" id=enrollmenttid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddEnrollmentStatus">
                                    <input type="submit"  id="formvalidate" data-form="formaddenrollmentstutus"  class="btn btn-info btn-md btn-submit"  value="Add Enrollment Status">
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
