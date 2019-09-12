<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>CCA (Sporting) </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>CCA (Sporting)</strong>
                    </span>
                                        
                    <a href="add_cca.php" class="btn btn-info btn-xs pull-right">Add CCA (Sporting)</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>     
                                    <th>CCA (Sporting) Name</th>
                                    <th>Class Schedule</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Student Name</th>
                                    <th>CCA Group Number</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT a.*,s.student_name FROM cca a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['cca_id'];?>">                                  
                                    <td><?php echo $r1['cca_id']; ?></td>
                                    <td><?php echo $r1['cca_name']; ?></td>
                                    <td><?php echo $r1['schedule']; ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($r1['start_date'])); ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($r1['finish_date'])); ?></td>
                                    <td><?php echo $r1['student_name']; ?></td>
                                    <td><?php echo $r1['cca_group']; ?></td>
                                    
                                    <!-- <td><?php //echo $r1['email_id']; ?></td>
                                    <td><?php //echo $r1['address']; ?></td>
                                    <td><img src="../upload/<?php //echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                         -->
                        <td> 
                                    
                        
                        
                        <a class="btn btn-xs btn-info" href="add_cca.php?id=<?php echo $r1['cca_id'];?>" ><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <?php if(permission_access($db,$per_id,'cca_delete')==1){ ?>

                        <a class="btn btn-xs btn-danger Deletecca" href="javascript:void(0);" title="Delete cca" data-id="<?php echo $r1['cca_id']; ?>"><i class="fa fa-trash"> </i></a>
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
