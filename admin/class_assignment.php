<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Class Assignment</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Class Assignment</strong>
                    </span>
                                        
                    <a href="add_class_assignment.php" class="btn btn-info btn-xs pull-right">Add Class Assignment</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th> 
                                    <th>Age</th>
                                    <th>Class Room</th> 
                                    <th>Academic</th> 
                                    <th>CCA</th>
                                    <th>Creative</th>                        
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT c.*,a.class_academic_name,v.cca_name,p.classes_name,s.student_name,s.age_year FROM class_assignment c LEFT JOIN class_academic a ON c.class_academic_id=a.class_academic_id LEFT JOIN cca v ON c.cca_id=v.cca_id LEFT JOIN creative_classes p ON c.creative_classes_id=p.creative_classes_id LEFT JOIN school_application s ON c.student_app_id=s.student_app_id") or die(mysqli_error($db));
                                
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['student_name']; ?></td>
                                        <td><?php echo $r1['age_year']; ?></td>
                                        <td><?php echo $r1['class_room']; ?></td>
                                        <td><?php echo $r1['class_academic_name']; ?></td>
                                        <td><?php echo $r1['cca_name']; ?></td>
                                        <td><?php echo $r1['classes_name']; ?></td>
                                        <td>
                                              
                                            <a class="btn btn-xs btn-info" href="add_class_assignment.php?id=<?php echo $r1['class_assignment_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'class_assignment_delete')==1){ ?>
                                            <a class="btn btn-xs btn-danger DeleteClassAssignment" href="javascript:void(0);" title="Delete Class Assignment" data-id="<?php echo $r1['class_assignment_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
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
</section>
<?php include("footer.php"); ?>
