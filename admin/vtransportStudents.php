<?php include("header.php");
if(isset($_GET["sid"]) || $_GET["sid"]!='')
{
$sid=$_GET["sid"];
//echo "SELECT t1.*,t2.first_name,t2.last_name,t2.mobile_number,t2.transport_drivers_id FROM transport_schedules as t1 join transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id where t1.transport_schedules_id='$sid'";
$q3=mysqli_query($db,"SELECT t1.*,t2.first_name,t2.last_name,t2.mobile_number,t2.transport_drivers_id FROM transport_schedules as t1 join transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id where t1.transport_schedules_id='$sid'");
$r3=mysqli_fetch_assoc($q3);
$driver=$r3["first_name"].' '.$r3["last_name"];	
$driver_mobile=$r3["mobile_number"];
$driver_id=$r3["transport_drivers_id"];
	
}
else
{
	echo "<script>window.location.href='transport_schedules.php';</script>";
}
 ?>
 
  
    <section id="middle">
      
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <strong>Transport Students </strong>
                    </span>          
                   
					 <a href="add_students_for_trans_schedule.php?sid=<?php echo $sid ;?>"  class="btn btn-info btn-xs pull-right addschedule"><i class="fa fa-plus"></i> Add Students</a></li>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sn.</th>
                                    <th>Driver Name</th>             
                                    <th>Contact No.</th>                                    
                                    <th>Students</th>                                    
                                    <th>Pickup-Drop Time</th>            
                                    <th>Pickup Address</th>            
                                    <th>Drop Address</th>            
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            /*echo "SELECT t1.*,t2.drop_locations from transport_students as t1 join transport_routes as t2 on t1.drop_loc_id=t2.transport_routes_id where t1.driver_id='$driver_id'";
							 $query = "SELECT t1.*,t2.drop_locations from transport_students as t1 join transport_routes as t2 on t1.drop_loc_id=t2.transport_routes_id where t1.driver_id='$driver_id'";*/
                             $query = "SELECT t1.*,
                                    concat(t2.first_name,' ',t2.last_name) as full_name,
                                    t2.mobile_number,
                                    t3.student_app_id,
                                    t3.student_name
                                    FROM transport_students t1
                                    LEFT JOIN transport_drivers t2 
                                    ON t1.driver_id = t2.transport_drivers_id 
                                    LEFT JOIN school_application t3
                                    ON t1.students_id = t3.student_app_id";
                              $q1 =mysqli_query($db,$query);						 
                               while($r1=mysqli_fetch_assoc($q1))
                               {           
                            					
                                ?>
                            <tr id="<?php echo $r1['id'];?>">
                                    <td><?php echo $i++; ?>.</td>
                                    <td><?php echo $r1['full_name'] ; ?></td>
                                    <td><?php echo $r1['mobile_number']; ?></td> 
                                    <td><a href="#" data-toggle="tooltip" data-placement="top" title="
                                   <?php    
                                   //echo "SELECT * from school_application as t1 WHERE t1.student_app_id IN(".$r1["student_app_id"].")";
                                   $q3=mysqli_query($db,"SELECT * from school_application as t1 WHERE t1.student_app_id IN(".$r1["student_app_id"].")"); 
                                   while($r3=mysqli_fetch_assoc($q3))
                                   {
                                    $std=$r3['student_name'];  
                                    echo $std.',';
                                   }?>">
                                   <?php 
                                     $total_std=explode(',',$r1["student_app_id"]);
                                     //echo $total_std;
                                     echo count($total_std);
                                   ?></a>                                  
                                    </td>
                                    <td><?php echo $r1['pickup_start_time'].'<br>'.$r1['pickup_end_time']; ?></td> 
									<td><?php echo $r1['pick_location']; ?></td> 
									<td><?php echo $r1['drop_loc_id']; ?></td> 
									<td>
									 <a  href="javascript:void(0);" data-id="<?php echo $r1['id']; ?>" title="View Students" class="btn btn-xs btn-primary oneviewData " ><i class="fa fa-eye"></i>One View</a>
                                    <a class="btn btn-xs btn-info " href="add_students_for_trans_schedule.php?sid=<?php echo $sid ;?>&id=<?php echo $r1['id'];?>"  ><i class="fa fa-edit"></i></a>
                                  
                                        <a class="btn btn-xs btn-danger DeleteStudentSchedule " href="javascript:void(0);" title="Delete Transport Schedules" data-id="<?php echo $r1['id']; ?>"><i class="fa fa-trash"> </i></a>
                                        &nbsp;                                       
                                    </td>
                            </tr>
                            <?php }?>
                            
                            </tbody>
                              
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?> 
