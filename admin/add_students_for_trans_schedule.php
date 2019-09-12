<?php include("header.php");
if(!empty($_GET["sid"]) && !empty($_GET["id"]))
{
$sid=$_GET["sid"];
$id=$_GET["id"];

//echo "SELECT t1.*FROM transport_schedules as t1 join transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id where transport_schedules_id='$sid'";

//echo "SELECT t1.* FROM transport_schedules as t1 join transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id where transport_schedules_id='$sid'";

$q31=mysqli_query($db,"SELECT t1.* FROM transport_schedules as t1 join transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id where transport_schedules_id='$sid'");
$r31=mysqli_fetch_assoc($q31);
	
$driver_id=$r31["driver_id"];

//echo "SELECT t1.*,t2.drop_locations from transport_students as t1 LEFT JOIN transport_routes as t2 on t1.drop_loc_id=t2.transport_routes_id LEFT JOIN school_application t3 on t1.students_id=t3.student_app_id where t1.id='$id'";

$q4=mysqli_query($db,"SELECT t1.*,t2.drop_locations from transport_students as t1 LEFT JOIN transport_routes as t2 on t1.drop_loc_id=t2.transport_routes_id LEFT JOIN school_application t3 on t1.students_id=t3.student_app_id where t1.id='$id'");
//echo "SELECT t1.*,t2.drop_locations from transport_students as t1 join transport_routes as t2 on t1.drop_loc_id=t2.transport_routes_id where t1.id='$id'";
$r4=mysqli_fetch_assoc($q4);	
}
elseif(!empty($_GET["sid"]) && $_GET["sid"]!='' )
{
$sid=$_GET["sid"];



$q31=mysqli_query($db,"SELECT t1.*FROM transport_schedules as t1 LEFT JOIN transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id where transport_schedules_id='$sid'");
$r31=mysqli_fetch_assoc($q31);
	
$driver_id=$r31["driver_id"];

}
else
{
	echo "<script>window.location.href='transport_schedules.php';</script>";
}
 ?>
<section id="middle">
    
    
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php 
				echo isset($id)?'Edit Students':'Add Students ';?></h2>
            </div>
            <div class="panel-body">
             <form action="" id = "ManageScheduleStudents" method="post" enctype="multipart/form-data">
                    <fieldset>			
				<div class="form-group">

					<div class="row">
					 <div class="col-md-6 col-sm-6 ">
					 <label>Pickup Location</label>
					  <div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="student_pickup" name="pick_location" required >
						<option value="<?php echo isset($id)?$r4["pick_location"]:'';?>"><?php echo isset($id)?$r4["pick_location"]:'Select';?></option>
						<?php
							
							$sql = mysqli_query($db,"SELECT DISTINCT pickup_id FROM transport_routes order by pickup_id asc");
							while ($r1 = mysqli_fetch_array($sql))
							{
									if($r1['pickup_id'] == '1'){
                                    	$r1['pickup_id'] = 'Danga Bay (Starbucks)';
                                    }
                                    if($r1['pickup_id'] == '2'){
                                    	$r1['pickup_id'] = 'Teega A (lobby)';
                                    }
                                    if($r1['pickup_id'] == '3'){
                                    	$r1['pickup_id'] = 'Teega B (lobby)';
                                    }
                                    if($r1['pickup_id'] == '4'){
                                    	$r1['pickup_id'] = 'Teega Suites (lobby)';
                                    }
                                    if($r1['pickup_id'] == '5'){
	                                    $r1['pickup_id'] = 'Mall of medini(lobby)';
	                                }
                                    if(!empty($r1["pickup_id"])){
                                    
							?>
							<option value="<?php echo $r1["pickup_id"]; ?>"><?php echo $r1["pickup_id"]; ?></option>
							<?php } } ?>
						</select>
					  </div>
					 </div>
					<div class="col-md-6 col-sm-6 ">
					   <label>Drop Location</label>
					    <div class="fancy-form fancy-form-select">
					    	<?php //echo $r4["drop_loc_id"]; ?>
						<select class="form-control select2" id="drop_location" name="drop_loc_id" required="">
						<option value="<?php echo isset($id)?$r4["drop_loc_id"]:'';?>"><?php echo isset($id)?$r4["drop_loc_id"]:'Select';?></option>
						</select>
					   </div>
					</div>
				
						</div> 
                    <div class="clearfix"></div>
                   	<div class="row">
					    <div class="col-md-12 col-sm-12">
							<label>Students *</label>
							 <select id="students" name="students[]" class="form-control select2" multiple required="">
							<?php 
								$q2=mysqli_query($db,"SELECT t1.* FROM school_application t1 WHERE t1.student_app_id  ='$r4[students_id]'"); 
								while($r2=mysqli_fetch_assoc($q2)){
									$std=$r2['student_name'];  
									echo '<option value="'.$r2['student_app_id'].'" selected>'.$r2['student_name'].'</option>';
							  	} 
							?>							
						</select>
					    </div>				   
				    </div>
                  
                  	<div class="row">
					  <div class="col-md-6 col-sm-6 ">
						<div class="col-md-12"><label>Pickup Time *</label></div>
						<div class="col-md-5">
						<input type="text" class="form-control timepicker"  placeholder = "Start Time" class = "form-control" name = "pick_time" id = "pick_time" title = "Time is Required"  value="<?php echo isset($id)?$r4["pickup_start_time"]:''?>"required >
						</div>
						<label class="col-md-2">To</label>
						<div class="col-md-5">
						<input type="text" class="form-control timepicker"  placeholder = "End Time" class = "form-control" name = "till_time" id = "till_time" title = "Time is Required"  value="<?php echo isset($id)?$r4["pickup_end_time"]:''?>"required >
						</div>	
					   </div>	
                       <div class="col-md-6 col-sm-6 ">
					   <label>Remark</label>
					   
						<textarea name="remark" id="remark" rows="4" class="form-control "><?php echo isset($id)?$r4["remark"]:'';?></textarea>
					   
						</div>					   
				  	</div>
                  	<div class="clearfix"></div>	

				  
					</div>

                          
					<div class="row">
					  <div class="form-group">
					    <div class="col-md-12 col-sm-12 text-center">
						  <input type ="hidden" name = "type" value="ManageScheduleStudents">
						  <input type ="hidden" name = "id" value="<?php echo isset($id)?$id:'';?>">
						  <input type ="hidden" name ="schedule_id" value="<?php echo isset($sid)?$sid:'';?>">
						  <input type ="hidden" name ="driver_id" value="<?php echo $driver_id;?>">
					      <input type="submit"  id="formvalidate" data-form="ManageScheduleStudents"  class="btn btn-info btn-md btn-submit"  value="<?php echo isset($id)?'Update':'Save'?>">
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
