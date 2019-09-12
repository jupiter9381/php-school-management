<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `transport_vehicles` WHERE `transport_vehicles_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Transport Vehicle</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['transport_vehicles_id'])?'Edit Transport Vehicle':'Add Transport Vehicle';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddtransportvehicle" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Vehicle Name *</label>
                                    <input type="text"  placeholder = "Vehicle Name" class = "form-control" name = "vehicle_name" id = "vehicle_name" title = "First Name Required"  value="<?php echo isset($data['vehicle_name'])?$data['vehicle_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Vehicle Type *</label>
                                    <input type="text"  placeholder = "Vehicle Type" class = "form-control" name = "vehicle_type" id = "vehicle_type" title = "last Name Required"  value="<?php echo isset($data['vehicle_type'])?$data['vehicle_type']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Registration Number *</label>
                                    <input type="text"  placeholder = "Registration Number" class = "form-control" name = "registration_number" id = "registration_number" title = "Id Number Required"  value="<?php echo isset($data['registration_number'])?$data['registration_number']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Vehicle Number *</label>
                                    <input type="text"  placeholder = "Vehicle Number" class = "form-control" name = "vehicle_number" id = "vehicle_number" title = "Mobile Number Required"  value="<?php echo isset($data['vehicle_number'])?$data['vehicle_number']:''?>"required>
                                </div>  
                            </div>
                           

                            <div class="row">                                   
                                <div class="col-md-6 col-sm-6">
                                    <label>Vehicle Image *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png">
                                    <input type="text" class="form-control" placeholder="No file selected" readonly="" value="<?php echo isset($data['image'])?$data['image']:''?>" required> >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddTransportVehicle">
                                        <input type="submit"  id="formvalidate" data-form="formaddtransportvehicle"  class="btn btn-info btn-md btn-submit"  value="Add Transport Vehicle">
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
