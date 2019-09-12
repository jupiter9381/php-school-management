<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `camp_teacher` WHERE `camp_teacher_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Incident Reports</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['camp_teacher_id'])?'Edit IncidentReports':'Add Incident Reports';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddincidentreports" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Driver Name *</label>
                                    <input type="text"  placeholder = "Driver Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Transport Number *</label>
                                    <input type="text"  placeholder = "Transport Number" class = "form-control" name = "last_name" id = "last_name" title = "last Name Required"  value="<?php echo isset($data['last_name'])?$data['last_name']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Number of Students *</label>
                                    <input type="text"  placeholder = "Number of Students" class = "form-control" name = "id_number" id = "id_number" title = "Id Number Required"  value="<?php echo isset($data['id_number'])?$data['id_number']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "last_name" id = "last_name" title = "last Name Required"  value="<?php echo isset($data['last_name'])?$data['last_name']:''?>"required>
                                </div>
                                  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Pickup Location *</label>
                                    <input type="text"  placeholder = "Pickup Location" class = "form-control" name = "mobile_number" id = "mobile_number" title = "Mobile Number Required"  value="<?php echo isset($data['mobile_number'])?$data['mobile_number']:''?>"required>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Drop Location *</label>
                                    <input type="text"  placeholder = "Drop Location" class = "form-control" name = "email_id" id = "email_id" title = "Email Id Required"  value="<?php echo isset($data['email_id'])?$data['email_id']:''?>"required>
                                </div> 
                            </div>

                          
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddIncidentReports">
                                        <input type="submit"  id="formvalidate" data-form="formaddincidentreports"  class="btn btn-info btn-md btn-submit"  value="Add Incident Reports">
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
