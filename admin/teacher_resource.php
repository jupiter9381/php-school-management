<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Teacher / Resource Assignment</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Teacher / Resource Assignment</strong>
                    </span>
                                        
                    <a href="add_teacher_resource.php" class="btn btn-info btn-xs pull-right">Add Teacher / Resource Assignment</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sn.</th>                                  
                                    <th>Name</th>
                                    
                                    <th>Designation</th>
                                    <th>Mobile No.</th>
                                    <th>Email </th>
                                    <th>Adress</th>
                                    <th>Image</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;

                            $q1 = mysqli_query($db, "SELECT * FROM `teacher_resource_assignment`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             

                
                                ?>
                            <tr id="invoice<?php echo $r1['teacher_resource_assignment_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $r1['first_name'].' '.$r1['last_name']; ?></td>
                                  
                                    <td><?php echo $r1['designation']; ?></td>
                                    <td><?php echo $r1['mobile_number'];?></td>
                                    <td><?php echo $r1['email_id']; ?></td>
                                    <td><?php echo $r1['address']; ?></td>
                                    <td><img src="../upload/<?php echo $r1['image'];?>" alt="Image" width="50" height="50"></td>
                                        
                      <td>                       
                         <a class="btn btn-xs btn-primary" target="_blank" href="../upload/<?php echo $r1['doc'];?>" title="Document File"><i class="fa fa-download"></i></a>
                       
                        <a class="btn btn-xs btn-info" href="add_teacher_resource.php?id=<?php echo $r1['teacher_resource_assignment_id'];?>" ><i class="fa fa-edit"></i></a>
                       
                        <?php if(permission_access($db,$per_id,'teacher_resource_management_delete')==1){ ?>

                        <a class="btn btn-xs btn-danger Deleteteacherassignment" href="javascript:void(0);" title="Delete Teacher Assignment" data-id="<?php echo $r1['teacher_resource_assignment_id']; ?>"><i class="fa fa-trash"> </i></a>
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
