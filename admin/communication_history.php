<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Communication History</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Communication History</strong>
                    </span>
                                        
                    <a href="add_communication_history.php" class="btn btn-info btn-xs pull-right">Add Communication History</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th> 
                                    <th>File</th> 
                                    <th>Date</th>  
                                    <th>Time</th>                      
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from communication_history");
                                $q1 = mysqli_query($db, "SELECT a.*,s.student_name FROM communication_history a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id ");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['student_name'];; ?></td>
                                        
                                        <!--<td><img src="../uploads/<?php echo $r1['upload_file'];?>" alt="Image" width="100" height="100"></td>-->
                                        <td><a href="../uploads/<?php echo $r1['upload_file'];?>" Download ><i class="fa fa-download"></i> Download </td>
                                        <td><?php echo date('d-m-Y',strtotime($r1['communication_date'])); ?></td>
                                        <td><?php echo $r1['time'];; ?></td>
                                        

                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_communication_history.php?id=<?php echo $r1['communication_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'communication_history_delete')==1){ ?>
                                            <a class="btn btn-xs btn-danger DeleteCommunicationoHistory" href="javascript:void(0);" title="Delete Communicationo History" data-id="<?php echo $r1['communication_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
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
