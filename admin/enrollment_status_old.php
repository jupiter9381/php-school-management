<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Enrollment Status</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Enrollment Status</strong>
                    </span>
                                        
                    <a href="add_enrollment_status.php" class="btn btn-info btn-xs pull-right">Add Enrollment Status</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Enrollment Date</th>                           
                                    <th>Notes</th>
                                    <th>Enrollment Value</th>  
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from enrollment_status");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($r1['enrollment_date'])); ?></td>
                                        
                                        <td><?php echo $r1['enrollment_notes'];; ?></td>
                                        <td><?php echo $r1['enrollment_value'];; ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_enrollment_status.php?id=<?php echo $r1['enrollment_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'enrollment_status_delete')==1){ ?>
                                            <a class="btn btn-xs btn-danger DeleteEnrollmentStatus" href="javascript:void(0);" title="Delete Enrollment Status" data-id="<?php echo $r1['enrollment_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
                                            <?php } ?>
                                            
                                        </td>
                                    </tr>  
                                <?php $i++;} ?>  
                            </tbody>
                              
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
