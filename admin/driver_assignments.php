<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Driver Assignments</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Driver Assignments</strong>
                    </span>
                                        
                    <a href="add_driver_assignments.php" class="btn btn-info btn-xs pull-right">Add Driver Assignments</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>                                  
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email Id</th>
                                    <th>Driving License Number</th>
                                    <th>Adress</th>
                                    <th>Image</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `driver_assignments`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['driver_assignments_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['id_number']; ?></td>
                                    <td><?php echo $r1['first_name']; ?></td>
                                    <td><?php echo $r1['last_name']; ?></td>
                                    <td><?php echo $r1['mobile_number'];?></td>
                                    <td><?php echo $r1['email_id']; ?></td>
                                    <td><?php echo $r1['driving_license']; ?></td>
                                    <td><?php echo $r1['address']; ?></td>
                                    <td><img src="../upload/<?php echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                        
                                    <td>                       
                        
                                        <a class="btn btn-xs btn-info" href="add_driver_assignments.php?id=<?php echo $r1['driver_assignments_id'];?>" ><i class="fa fa-edit"></i></a>
                                        &nbsp;                         
                                       
                                        <?php if(permission_access($db,$per_id,'driver_assignment_delete')==1){ ?>

                                        <a class="btn btn-xs btn-danger DeleteDriverAssignments" href="javascript:void(0);" title="Delete Driver Assignments" data-id="<?php echo $r1['driver_assignments_id']; ?>"><i class="fa fa-trash"> </i></a>
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
