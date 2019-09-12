<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `transport_schedules` WHERE `transport_schedules_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Transport Schedules</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['transport_schedules_id'])?'Edit Transport Schedules':'Add Transport Schedules';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddtransportschedules" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "date" id = "date" title = "Student Name Required"  value="<?php echo isset($data['date'])?$data['date']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">    
                                <label>Number of Students </label>
                                <input type="text" class="form-control"  placeholder = "Number of Students" name = "students" id = "students" title = "Number of Students Required"  value="<?php echo isset($data['students'])?$data['students']:''?>"required>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Pickup Locations</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="pickup_locations" name="pickup_locations">
                                        <option value="">--Select--</option>
                                        <?php
                                        $selectpck = "SELECT * FROM transport_routes";
                                        $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['transport_routes_id']) && $row['transport_routes_id'] == $data['transport_routes_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['pickup_locations']; ?>" <?=$selected;?>><?php echo $row['pickup_locations']; ?></option>
                                        
                                        <?php }?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Drop Locations</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="drop_locations" name="drop_locations">
                                            <option value="">--Select--</option>
                                         <?php
                                            $selectpck = "SELECT * FROM transport_routes";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['transport_routes_id']) && $row['transport_routes_id'] == $data['transport_routes_id'])?'selected':'';
                                        ?>
                                            <option value="<?php echo $row['drop_locations']; ?>" <?=$selected; ?>><?php echo $row['drop_locations']; ?></option>>
                                        
                                        <?php }?> 
                                        </select>
                                    </div>
                                   
                                </div>  
                            </div> 

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                <label>Boarding Staff</label>
                                    <div class="fancy-form fancy-form-select">
                                    <select class="form-control select2" id="boarding_staff" name="boarding_staff">
                                    <option value="">--Select--</option>
                                         <?php
                                            $selectpck = "SELECT * FROM boarding_staff";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['boarding_staff_id']) && $row['boarding_staff_id'] == $data['boarding_staff_id'])?'selected':'';
                                        ?>
                                    <option value="<?php echo $row['first_name']; ?>" <?=$selected; ?>><?php echo $row['first_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Drivers </label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="drivers" name="drivers">
                                            <option value="">--Select--</option>
                                         <?php
                                            $selectpck = "SELECT * FROM transport_drivers";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['transport_drivers_id']) && $row['transport_drivers_id'] == $data['transport_drivers_id'])?'selected':'';
                                        ?>
                                            <option value="<?php echo $row['first_name']; ?>" <?=$selected; ?>><?php echo $row['first_name']; ?></option>
                                        
                                        <?php }?> 
                                        </select>
                                    </div>
                                </div>  
                            </div>

                            

                            
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Addtransportschedules">
                                        <input type="submit"  id="formvalidate" data-form="formaddtransportschedules"  class="btn btn-info btn-md btn-submit"  value="Add Transport Schedules">
                                    </div>
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
