
<?php
session_start();
//Include database
include '../db_config.php';





/*
 * Fetch Schedule Details for One View
 */


if(isset($_POST["list_id"]))
{
  $output = '';
  $id = $_POST['list_id'];
      $result = mysqli_query($db, "SELECT t1.*,t2.drop_locations from transport_students as t1 join transport_routes as t2 on t1.drop_loc_id=t2.transport_routes_id where t1.id='$id'");  
      echo '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($r1 = mysqli_fetch_array($result))  
      {  
              ?>
		   <tr>  
                     <th width="30%"><label>Pick Address</label></th>  
                     <td width="70%"><?php echo $r1["pick_location"];?></td>  
                </tr> 
				<tr>  
                     <th width="30%"><label>Drop Address</label></th>  
                     <td width="70%"><?php echo $r1["drop_locations"];?></td>  
                </tr>
				<tr>  
                     <th width="30%"><label>Students</label></th>  
                     <td width="70%"><?php 
					 
					 $q2=mysqli_query($db,"SELECT t1.*,t2.first_name,t2.middle_name,t2.last_name FROM school_application as t1 join student_profile as t2 on t1.student_profile_id=t2.student_profile_id WHERE t1.student_profile_id IN(".$r1["students_id"].")"); 
				   while($r2=mysqli_fetch_assoc($q2))
				   {
					$std=$r2['first_name'].' '.$r2['middle_name'].' '.$r2['last_name'];  
					echo $std.',';
				   }
			?>		 

                </tr>
				 <tr>  
                     <th width="30%"><label>Pickup Time</label></th>  
                     <td width="70%"><?php echo $r1["pickup_start_time"].' - '.$r1["pickup_end_time"];?></td>  
					  <tr>  
                     <th width="30%"><label>Remarks</label></th>  
                     <td width="70%"><?php echo $r1["remark"];?></td>  
                </tr> 
        
     <?php }  
      echo  "</table></div>";  
     // echo $output;  
    
}















?>














