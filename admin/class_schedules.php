<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Class Schedules </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Class Schedules</strong>
                    </span>
                                        
                    <a href="add_class_schedules.php" class="btn btn-info btn-xs pull-right">Add Class Schedules</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
					
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    
                                    <th>Camp Name</th>
                                    <th>Class Name</th>    
                                    <th>Day</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db,"SELECT t1.*,t2.camp_name FROM `class_schedules` as t1 join `camp_management` as t2 on t1.camp_id=t2.camp_management_id");
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['class_schedules_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['camp_name']; ?></td>
                                    <td><?php echo $r1['class_name']; ?></td>
                                    <td><?php echo $r1['day']; ?></td>
                                    <td><?php echo $r1['date'];?></td>
                                    <td><?php echo $r1['time']; ?></td>
                                   
                                        
                      <td>                       
                        
                        <a class="btn btn-xs btn-info" href="add_class_schedules.php?id=<?php echo $r1['class_schedules_id'];?>" ><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <?php if(permission_access($db,$per_id,'class_schedules_delete')==1){ ?>
                        <a class="btn btn-xs btn-danger Deleteclassschedules" href="javascript:void(0);" title="Delete Class Schedules" data-id="<?php echo $r1['class_schedules_id']; ?>"><i class="fa fa-trash"> </i></a>
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
