<?php include("header.php"); ?>

    <section id="middle">
      
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Boarding Activities</strong>
                    </span>
                                        
                    <a href="add_boarding_activities.php" class="btn btn-info btn-xs pull-right">Add Boarding Activities</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                     <th>Sr.No.</th>           
                                    <th>Boarding Activities Name</th>
                                    <th>Class Schedule</th>
                                    <th>Start Date</th>
                                    <th>Finish Date</th>                                   
                                    <th>Students</th>
									<th>Teachers</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                           <tbody>
                            <?php
                            $i=1;

                            $q1 = mysqli_query($db, "SELECT a.*,s.student_name,c.class_name FROM boarding_activities a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id join class_schedules as c on a.schedule=c.class_schedules_id");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                           
                                ?>
                            <tr>                                  
                                    
                                   <td><?php echo $i++;?>.</td>
                                   <td><?php echo $r1['boarding_activities_name']; ?></td>
                                   <td><?php echo $r1['class_name'];?></td>
                                   <td><?php echo date('d-m-Y',strtotime($r1['start_date'])); ?></td>
                                   <td><?php echo date('d-m-Y',strtotime($r1['finish_date'])); ?></td>
                                     <td>
								   
                                   <a href="#" data-toggle="tooltip" data-placement="top" title="
								   <?php	
								   $q3=mysqli_query($db,"SELECT *from   school_application as t1 WHERE t1.student_app_id IN(".$r1["student_app_id"].")"); 
								   while($r3=mysqli_fetch_assoc($q3))
								   {
									$std=$r3['student_name'];  
									echo $std.',';
								   }?>">
								   <?php 
                                     $total_std=explode(',',$r1["student_app_id"]);
									 echo count($total_std);
								   ?></a>								   
									</td>
									 <td>
			      	               
									<a href="#" data-toggle="tooltip" data-placement="top" title="<?php  $q2=mysqli_query($db,"SELECT *FROM teacher_resource_assignment WHERE teacher_resource_assignment_id IN(".$r1["teachers_id"].")"); 
								   while($r2=mysqli_fetch_assoc($q2))
								   {
									$teacher=$r2['first_name'].' '.$r2['last_name'];  
									echo $teacher.',';
								   }?>">
									<?php 
                                     $total_teachers=explode(',',$r1["teachers_id"]);
									 echo count($total_teachers);
								   ?>
									</a>
									</td>
                                        
                             <td>                       
                        
                        <a class="btn btn-xs btn-info" href="add_boarding_activities.php?id=<?php echo $r1['boarding_activities_id'];?>" ><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <?php if(permission_access($db,$per_id,'boarding_activity_delete')==1){ ?>
                        <a class="btn btn-xs btn-danger Deleteboardingactivities" href="javascript:void(0);" title="Delete Boarding Activities" data-id="<?php echo $r1['boarding_activities_id']; ?>"><i class="fa fa-trash"> </i></a>
                        &nbsp; 
                        <?php }?>                                        
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
