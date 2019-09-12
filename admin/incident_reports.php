<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Incident Reports</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Incident Reports</strong>
                    </span>
                                        
                    <a href="add_incident_reports.php" class="btn btn-info btn-xs pull-right">Add Incident Reports</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                                                    
                                    <th>Driver Name</th>
                                    <th>Transport Number</th>
                                    <th>Number of Students</th>
                                    <th>Date</th>
                                    <th>Pickup Location</th>
                                    <th>Drop Location</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <!-- <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `camp_teacher`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['camp_teacher_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['id_number']; ?></td>
                                    <td><?php echo $r1['first_name']; ?></td>
                                    <td><?php echo $r1['last_name']; ?></td>
                                    <td><?php echo $r1['mobile_number'];?></td>
                                    <td><?php echo $r1['email_id']; ?></td>
                                    <td><?php echo $r1['address']; ?></td>
                                    <td><img src="../upload/<?php echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                        
                      <td>                       
                        
                        <a class="btn btn-xs btn-info" href="add_campteachers.php?id=<?php echo $r1['camp_teacher_id'];?>" ><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <a class="btn btn-xs btn-danger DeleteCampTeacher" href="javascript:void(0);" title="Delete Camp Teacher" data-id="<?php echo $r1['camp_teacher_id']; ?>"><i class="fa fa-trash"> </i></a>
                        &nbsp;                                       
                      </td>
                    </tr>
                             <?php }?>
                            
                            </tbody> -->
                              
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
