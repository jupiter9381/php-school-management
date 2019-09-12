<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `transport_incident_reports` WHERE `transport_incident_reports_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Transport Incident Reports</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['transport_incident_reports_id'])?'Edit TransportIncidentReports':'Add Transport Incident Reports';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddtransportincidentreports" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Driver Name *</label>
                                    <input type="text"  placeholder = "Driver Name" class = "form-control" name = "driver_name" id = "driver_name" title = "First Name Required"  value="<?php echo isset($data['driver_name'])?$data['driver_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Transport Number *</label>
                                    <input type="text"  placeholder = "Transport Number" class = "form-control" name = "transport_number" id = "transport_number" title = "last Name Required"  value="<?php echo isset($data['transport_number'])?$data['transport_number']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Number of Students *</label>
                                    <input type="text"  placeholder = "Number of Students" class = "form-control" name = "students" id = "students" title = "Id Number Required"  value="<?php echo isset($data['students'])?$data['students']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "date" id = "date" title = "last Name Required"  value="<?php echo isset($data['date'])?date('d-m-Y',strtotime($data['date'])):'';?>"required>
                                </div>
                                  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Pickup Location *</label>
                                    <input type="text"  placeholder = "Pickup Location" class = "form-control" name = "pickup_location" id = "pickup_location" title = "Mobile Number Required"  value="<?php echo isset($data['pickup_location'])?$data['pickup_location']:''?>"required>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Drop Location *</label>
                                    <input type="text"  placeholder = "Drop Location" class = "form-control" name = "drop_location" id = "drop_location" title = "Email Id Required"  value="<?php echo isset($data['drop_location'])?$data['drop_location']:''?>"required>
                                </div> 
                            </div>

                          
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                    <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddTransportIncidentReports">
                                    <input type="submit"  id="formvalidate" data-form="formaddtransportincidentreports"  class="btn btn-info btn-md btn-submit"  value="Add Transport Incident Reports">
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
