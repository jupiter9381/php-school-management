<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Linked Student</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Linked Student</strong>
                    </span>
                                        
                    <a href="add_linked_student.php" class="btn btn-info btn-xs pull-right">Add Linked Student</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>                           
                                    <th>Last Name</th>
                                    <th>Number</th>                            
                                    <th>Picture</th>
                                    <th>Agent Name</th>  
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from linked_student");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['first_name']; ?></td>
                                        <td><?php echo $r1['last_name']; ?></td>
                                        <td><?php echo $r1['contact_number']; ?></td>
                                        <td><img src="../uploads/<?php echo $r1['picture']; ?>" width="50px" height="50px"></td>
                                        <td><?php echo $r1['agent_name']; ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_linked_student.php?id=<?php echo $r1['linked_student_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                             <?php if(permission_access($db,$per_id,'linked_student_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteLinkedStudent" href="javascript:void(0);" title="DeleteLinked Student" data-id="<?php echo $r1['linked_student_id']; ?>"><i class="fa fa-trash">Delete</i></a> 

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
