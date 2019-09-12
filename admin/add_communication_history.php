<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `communication_history` WHERE `communication_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Communication History</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['communication_id'])?'Edit Communication History':'Add Communication History';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddcammunication" method="post" enctype="multipart/form-data">
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
                                <div class="col-md-6 col-sm-6">
                                    <label>file*</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="upload_file" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'pdf'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['upload_file'])?$data['upload_file']:''?>" required> >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div> 
                                 
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Communication Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "communication_date" id = "communication_date" title = "Date Required"  value="<?php echo isset($data['communication_date'])?date('d-m-Y',strtotime($data['communication_date'])):'';?>"required>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                <label>Communication Time </label>
                                <input type="text" class="form-control timepicker" name="time" id="time" title="Communication Time" placeholder="Communication Time" value="<?php echo isset($data['time'])?$data['time']:'';?>" >  
                                    
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-6 col-sm-6">
                                <label>Student Relative </label>
                                <input type="text" class="form-control" name="relative" id="relative" title="Relative" placeholder="Student Relative" value="<?php echo isset($data['relative'])?$data['relative']:'';?>" >  
                                    
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Communication Notes </label>
                                    <textarea rows="5" class="form-control" name="communication_notes" id="communication_notes" title="Communication Notes" placeholder="Communication Notes"> <?php echo isset($data['communication_notes'])?$data['communication_notes']:''?></textarea>
                                </div>
                            </div> -->       
                            </div> 
                           
                            </div>                      
                           
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "communicationid" id="communicationid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddCommunicationHistory">
                                    <input type="submit"  id="formvalidate" data-form="formaddcammunication"  class="btn btn-info btn-md btn-submit"  value="Add Communication History">
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
