<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Camp Management </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Camp Management</strong>
                    </span>
                    
                    <a href="add_camp_management.php" class="btn btn-info btn-xs pull-right">Add Camp Management</a>                    
                    <a href="student_app.php" class="btn btn-info btn-xs pull-right">Go to Student Applications</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                                                      
                                    <th>Camp Name</th>
                                    <th>Messege</th> 
                                    <th>Start Date</th>
                                    <th>Finish Date</th>
                                    <th>Total</th>
                                    <th>Boarding</th>
                                    <th>Day</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;
                            $sql = "
                                SELECT cm.*, IF(a.nums IS NULL, 0, a.nums) total_num, IF(boarding_num IS NULL, 0, boarding_num) boarding_num, IF(day_num IS NULL, 0, day_num) day_num
                                FROM camp_management cm LEFT JOIN (
                                SELECT COUNT(*) nums, camp_management_id, SUM(IF(boarding_req = '1', 1, 0)) boarding_num, SUM(IF(boarding_req = '0', 1, 0)) day_num
                                FROM school_application
                                GROUP BY camp_management_id ) a ON cm.camp_management_id = a.camp_management_id
                            ";
                            $q1 = mysqli_query($db, $sql);                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                               {             
                                $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['camp_management_id'];?>">                                  
                                <td><?php echo $r1['camp_name']; ?></td>
                                <td><?php echo $r1['message']; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($r1['start_date'])); ?></td>
                                <td><?php echo date('d-m-Y',strtotime($r1['finish_date'])); ?></td>
                                <td><?php echo $r1['total_num']; ?></td>
                                <td><?php echo $r1['boarding_num']; ?></td>
                                <td><?php echo $r1['day_num']; ?></td>
                                <td>                       
                                    <a class="btn btn-xs btn-info" href="add_camp_management.php?id=<?php echo $r1['camp_management_id'];?>" ><i class="fa fa-edit"></i></a>
                                    &nbsp;                         
                                   
                                    <?php if(permission_access($db,$per_id,'camp_management_delete')==1){ ?>
                                    <a class="btn btn-xs btn-danger Deletecampmanagement  " href="javascript:void(0);" title="Delete Camp Management  " data-id="<?php echo $r1['camp_management_id']; ?>"><i class="fa fa-trash"> </i></a>
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
