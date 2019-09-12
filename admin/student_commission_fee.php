<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Student Commission Fee</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Student Commission Fee</strong>
                    </span>
                                        
                    <a href="add_student_commission_fee.php" class="btn btn-info btn-xs pull-right">Add Student Commission Fee</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>                           
                                    <th>Comission Fee</th>                            
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from commission_fee");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['student_comission_fee']; ?></td>
                                        <td><?php echo $r1['commission_fee']; ?></td>
                                        
                                        
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_student_commission_fee.php?id=<?php echo $r1['commission_fee_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'agent_commission_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteCommissionFee" href="javascript:void(0);" title="Delete Commission Fee" data-id="<?php echo $r1['commission_fee_id']; ?>"><i class="fa fa-trash">Delete</i></a> 

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
