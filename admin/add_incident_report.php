<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `incident_report` WHERE `incident_report_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Incident Report</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Incident Report':'Add Incident Report';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddincidentreport" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Title </label>
                                    <input type="text"  placeholder = "Title" class = "form-control" name = "title" id = "title" title = "Title Required"  value="<?php echo isset($data['title'])?$data['title']:''?>" >
                                </div> 
                               <div class="col-md-6 col-sm-6">
                                    <label>Student Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                    <select class="form-control select2"  id="student_profile_report" name="student_profile_id">
                                        <option value="">--Select--</option>
                                    <?php
                                        $selectpck = "SELECT * FROM student_profile";
                                        $sql = mysqli_query($db, $selectpck);
                                    while ($row = mysqli_fetch_array($sql)) {
                                        $selected = (isset($data['student_profile_id']) && $row['student_profile_id'] == $data['student_profile_id'])?'selected':'';
                                    ?>
                                    <option value="<?php echo $row['student_profile_id']; ?>" <?=$selected; ?>><?php echo $row['student_name']; ?></option>>
                                    
                                    <?php }?> 
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Reporting Staff </label>
                                    <div class="fancy-form fancy-form-select">
                                    <!-- <input type="text"  placeholder = "Reporting Staff" class = "form-control" name = "reporting_staff" id = "reporting_staff" title = "Reporting Staff Required"  value="<?php //echo isset($data['reporting_staff'])?$data['reporting_staff']:''?>" > -->
                                        <select class="form-control select2"  id="school_staff_report" name="school_staff_id">
                                            <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM school_staff";
                                            $sql = mysqli_query($db, $selectpck);
                                            while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['school_staff_id']) && $row['school_staff_id'] == $data['school_staff_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['school_staff_id']; ?>" <?=$selected; ?>><?php echo $row['first_name']; ?></option>>
                                        
                                        <?php }?> 
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date </label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "date" id = "date"title = "Date Required" value="<?php echo isset($data['date'])?$data['date']:''?>" >
                                </div>
                            </div>

                           <div class="row">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Time </label>
                                    <input type="text"  placeholder = "Time" class = "form-control timepicker" name = "time" id = "time" title = "Time Required"  value="<?php echo isset($data['time'])?$data['time']:''?>" >
                                </div> 
                                <div class="col-md-6 col-sm-6">
                                    <label>File Uploads</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="incident_file" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['incident_file'])?$data['incident_file']:''?>" > >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                                </div>
                            </div>   
                            <div class="row">
                                  <div class="col-md-6 col-sm-6 ">
                                    <label>Message (Text of incident)</label>
                                    <textarea class="form-control" rows="5" name="message_box" id="message_box"><?php echo isset($data['message_box'])?$data['message_box']:''?></textarea>
                                </div> 
                                
                            </div>                           
                           
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "reportid" id="reportid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddIncidentReport">
                                    <input type="submit"  id="formvalidate" data-form="formaddincidentreport"  class="btn btn-info btn-md btn-submit"  value="Add Incident Report">
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
