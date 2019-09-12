<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `camp_management` WHERE `camp_management_id` = '$id'"));
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Camp Management</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['camp_management_id'])?'EditCampManagement':'Add Camp Management';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formclassaddcampmanagement" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Camp Name *</label>
                                    <input type="text"  placeholder = "Camp Name" class = "form-control" name = "camp_name" id = "camp_name" title = "Camp Name Required"  value="<?php echo isset($data['camp_name'])?$data['camp_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Message Box *</label>
                                   <textarea rows="5" class="form-control"   placeholder = "Messege" class = "form-control" name = "message" id = "message" title = "Message Required"><?php echo isset($data['message'])?$data['message']:''?></textarea>
                                </div>  
                            </div> 


                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Start Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Start Date" class = "form-control" name = "start_date" id = "start_date" title = "Start Date Required"  value="<?php echo isset($data['start_date'])?date('d-m-Y',strtotime($data['start_date'])):'';?>" required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Finish Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Finish Date" class = "form-control" name = "finish_date" id = "finish_date" title = "Finish Date Required"  value="<?php echo isset($data['finish_date'])?date('d-m-Y',strtotime($data['finish_date'])):'';?>" required>
                                </div>  
                            </div>    


                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Number of Student *</label>
                                    <input type="text"  placeholder = "Number of Student" class = "form-control" name = "student_number" id = "student_number" title = "Number of Student Required"  value="<?php echo isset($data['student_number'])?$data['student_number']:''?>">
                                </div> 
                            </div>
                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddCampManagement">
                                        <input type="submit"  id="formvalidate" data-form="formclassaddcampmanagement  "  class="btn btn-info btn-md btn-submit"  value="Add Camp Management">
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
