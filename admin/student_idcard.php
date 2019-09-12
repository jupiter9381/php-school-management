<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Student ID Card</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Student ID Card</strong>
                    </span>
                                        
                    <a href="add_student_idcard.php" class="btn btn-info btn-xs pull-right">Add Student ID Card</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th> 
                                    <th>Student Type</th>                        
                                    <th>Alergies</th>
                                    <th>CCA Number</th>                         
                                    <th>Pick Points</th>   
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;

                                
                                $q1 = mysqli_query($db,"SELECT i.*,a.student_name,a.student_app_id,a.allergies,a.allergies_details,a.student_pickup,c.student_app_id,c.cca_name
                                                        FROM student_idcard i
                                                        LEFT JOIN school_application a ON 
                                                        i.student_app_id = a.student_app_id
                                                        LEFT JOIN cca c ON 
                                                        i.student_app_id = c.student_app_id");

                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['student_name']; ?></td>
                                        <td><?php echo $r1['student_type']; ?></td>
                                        <td><?php echo $r1['allergies']; ?></td>
                                        <td><?php echo $r1['cca_name']; ?></td>
                                        
                                        <td><?php echo $r1['student_pickup']; ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_student_idcard.php?id=<?php echo $r1['student_idcard_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'student_idcard_delete')==1){ ?>
                                            <a class="btn btn-xs btn-danger DeleteStudentIDCard" href="javascript:void(0);" title="Delete Student ID Card" data-id="<?php echo $r1['student_idcard_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
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
