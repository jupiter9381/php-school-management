<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Academic </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Academic</strong>
                    </span>
                                        
                    <a href="add_class_academic.php" class="btn btn-info btn-xs pull-right">Add Academic</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>            
                                    <th>Academic Name</th>
                                    <th>Class Schedule</th>
                                    <th>Start Date</th>
                                    <th>Finish Date</th>
                                    <th>No. of Student</th>
                                    <th>Teachers</th>
                                    <th>Class Room</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;

                            $q1 = mysqli_query($db, "SELECT a.*,s.student_name,c.class_name FROM class_academic a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id LEFT JOIN class_room r ON a.class_room_id=r.class_room_id join class_schedules c on a.schedule=c.class_schedules_id");                               
                                while($r1 = mysqli_fetch_assoc($q1))                        
                               {  
                                ?>
                            <tr id="invoice<?php echo $r1['class_academic_id'];?>">                                  
                                    
                                    <td><?php echo $i++; ; ?></td>
                                    <td><?php echo $r1['class_academic_name']; ?></td>
                                    <td><?php echo $r1['class_name'];?></td>
                                    <td><?php echo date('d-m-Y',strtotime($r1['start_date'])); ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($r1['finish_date'])); ?></td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="
                                       <?php    
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
                                        <?php //echo $r1['student_name']; ?>
                                    </td>
									
                                    <td>
				                    <?php  
                                        $q2=mysqli_query($db,"SELECT * FROM teacher_resource_assignment WHERE teacher_resource_assignment_id IN(".$r1["teacher_resource_assignment_id"].")"); 
        								while($r2=mysqli_fetch_assoc($q2))
        								{
        									$teacher=$r2['first_name'].' '.$r2['last_name'];  
        									echo $teacher.',';
        								}
                                    ?>
									
									</td>
                                    <td>
                                    <?php  
                                        $q2=mysqli_query($db,"SELECT * FROM class_room WHERE class_room_id IN(".$r1["class_room_id"].")"); 
                                        while($r4=mysqli_fetch_assoc($q2)) 
                                        {
                                            $teacher1=$r4['class_room_number'];  
                                            echo $teacher1.'';
                                        }
                                    ?>
                                    
                                    </td>
                                    
                                   
                                        
                                <td>     

                                    <a class="btn btn-xs btn-success AttendanceModel" data-toggle="modal" data-target="#attendance" data-id="<?php echo $r1['class_academic_id']; ?>"><i class="fa fa-book"></i></a> 
                                    
                                    <a class="btn btn-xs btn-info" href="add_class_academic.php?id=<?php echo $r1['class_academic_id'];?>" ><i class="fa fa-edit"></i></a>                     
                                   
                                    <?php if(permission_access($db,$per_id,'academic_delete')==1){ ?>
                                    <a class="btn btn-xs btn-danger DeleteClassAcademic" href="javascript:void(0);" title="Delete Class Academic" data-id="<?php echo $r1['class_academic_id']; ?>"><i class="fa fa-trash"> </i></a>
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


<div class="modal fade" id="attendance" role="dialog" style="">
    <div class="modal-dialog" style="width:950px;">
      <!-- Modal content-->
        <div class="modal-content" style="width: 950px;height: 600px;text-align: center;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Attendance / Roll Call feature</h4>
            </div>
            

            <form action="" id = "FormModalAttendance" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>            
                                    <th>Student Name</th>
                                    <th>Male/Female</th>
                                    <th>Nationality</th>
                                    <th>Age</th>
                                    <th>CCA Group</th>
                                    <th>Camp Name</th>

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
                        <input type ="hidden" name = "type" value="AddModalAttendance">
                        <input type ="hidden" name = "academic_id" value="">
                        <input type="submit"  id="" data-form="FormModalAttendance" class="btn btn-info btn-md btn-submit"  value="Add Attendance">
                    </div>
                    
                </div>
            </form>

        </div>
      
    </div>
</div>



<?php include("footer.php"); ?>
