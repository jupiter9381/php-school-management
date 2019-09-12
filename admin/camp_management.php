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
                                    <th>Student Number</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `camp_management`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                               {             
                                $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['camp_management_id'];?>">                                  
                                <td><?php echo $r1['camp_name']; ?></td>
                                <td><?php echo $r1['message']; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($r1['start_date'])); ?></td>
                                <td><?php echo date('d-m-Y',strtotime($r1['finish_date'])); ?></td>
                                <td><?php echo $r1['student_number']; ?></td>
                           
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
