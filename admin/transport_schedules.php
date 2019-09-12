<?php include("header.php");

 ?>
 
  
    <section id="middle">
        <header id="page-header">
            <h1>Transport Schedules </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Transport Schedules </strong>
                    </span>          
                   
					 <a href="javascript:void(0);" data-toggle="modal" data-target="#scheduleModal" class="btn btn-info btn-xs pull-right addschedule"><i class="fa fa-plus"></i> Add New Transport Schedule</a></li>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sn.</th>   
                                    <th>Schedule Date</th>   
                                    <th>Driver Name</th>             
                                    <th>Contact No.</th>                                    
                                    <th>Boarding Staff</th> 
                                    <th>Route Name </th>
                                    <th>Transport Driver (Phone)</th>
                                    <th>Transport Vehicle </th>           
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
							 $query = "SELECT t1.*,t2.first_name,t2.last_name,t2.mobile_number FROM transport_schedules as t1 join transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id ";
                              $q1 = mysqli_query($db,$query); 
													 
                               while($r1 = mysqli_fetch_assoc($q1))
                               {             
                            					
                                ?>
                            <tr id="<?php echo $r1['transport_schedules_id'];?>">
                                    <td><?php echo $i++; ?>.</td>
                                    <td><?php echo date('d-m-Y',strtotime($r1['schedule_date'])); ?></td>         
                              
                                    <td><?php echo $r1['first_name'].' '.$r1['last_name']; ?></td>                                       
									  <td><?php echo $r1['mobile_number']; ?></td> 
									  <td><?php 
									      $q2=mysqli_query($db,"SELECT *from boarding_staff where boarding_staff_id IN(".$r1["staff_id"].")");
										 
									      while($r2=mysqli_fetch_assoc($q2))
										  {
											echo $r2["first_name"].' '.$r2["last_name"].',';  
										  } 
									  ?></td> 

                                      <td><?php echo $r1['route_name']; ?></td>
                                      <td><?php echo $r1['phone']; ?></td>
                                      <td><?php echo $r1['vehicle']; ?></td>

                                    <td>
                                    
                                    <a class="btn btn-xs btn-primary " href="driver_schedule_report.php?id=<?php echo $r1['transport_schedules_id']; ?>" title="Print driver report" data-id=""><i class="fa fa-print"></i></a>
                                    
                                    <a class="btn btn-xs btn-success TransportModel" data-toggle="modal" data-target="#transport" data-id="<?php echo $r1['transport_schedules_id']; ?>"><i class="fa fa-book"></i></a>
                                    <a class="btn btn-xs btn-info EditSchedule" href="javascript:void(0);" data-id="<?php echo $r1['transport_schedules_id']; ?>" ><i class="fa fa-edit"></i></a>
                                    <a  href="add_students_for_trans_schedule.php?sid=<?php echo $r1['transport_schedules_id']; ?>"  title="Add Students" class="btn btn-xs btn-success addstudent"><i class="fa fa-plus"></i></a>
									 <a  href="vtransportStudents.php?sid=<?php echo $r1['transport_schedules_id']; ?>"  title="View Students" class="btn btn-xs btn-primary "><i class="fa fa-eye"></i></a>
                                        <?php if(permission_access($db,$per_id,'transport_schedule_delete')==1){ ?>
                                    
                                    <a class="btn btn-xs btn-danger Deletetransportschedules" href="javascript:void(0);" title="Delete Transport Schedules" data-id="<?php echo $r1['transport_schedules_id']; ?>"><i class="fa fa-trash"> </i></a>
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


<div class="modal fade" id="transport" role="dialog" style="">
    <div class="modal-dialog" style="width:950px;">
      <!-- Modal content-->
        <div class="modal-content" style="width: 950px;height: 600px;text-align: center;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Transport For Student</h4>
            </div>
            

            <form action="" id = "FormModalTransport" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>            
                                    <th>Driver Name</th>
                                    <th>Student</th>
                                    <th>Nationality</th>
                                    <th>Age</th>

                                    <?php 

                                        $date = date('d-M-Y');
                                        $ts = strtotime($date);
                                        $year = date('o', $ts);
                                        $week = date('W', $ts);
                                        for($i = 1; $i <= 7; $i++) {
                                            $ts = strtotime($year.'W'.$week.$i);
                                            //print date("m/d/Y l", $ts) . "\n";
                                    ?>

                                    <th><?=date("d-M-Y", $ts); ?></th>

                                    <?php } ?>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody> 
                              
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12 text-center">
                       <input type ="hidden" name = "modal_attendance" id="modal_attendance" value="<?php echo isset($id)?$id:'';?>">
                        <input type ="hidden" name = "type" value="AddModalTransport">
                        <input type ="hidden" name = "transport_id" value="">
                        <input type="submit"  id="" data-form="FormModalTransport" class="btn btn-info btn-md btn-submit"  value="Add Student Transport">
                    </div>
                    
                </div>
            </form>

        </div>
      
    </div>
</div>


<?php include("footer.php"); ?> 
