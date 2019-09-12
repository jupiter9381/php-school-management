<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Testing Result</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Testing Result</strong>
                    </span>
                                        
                    <a href="add_testing_result.php" class="btn btn-info btn-xs pull-right">Add Testing Result</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Test Number</th>
                                    <th>Speaking/Oral Test</th>
                                    <th>Interview Test</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from testing_result");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['test_number']; ?></td>
                                        <td><?php echo $r1['oral_test']; ?></td>
                                        <td><?php echo $r1['interview_test']; ?></td>
                                        
                                        <td>
                                              
                                            <a class="btn btn-xs btn-info" href="add_testing_result.php?id=<?php echo $r1['test_result_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'testing_result_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteTestingResult" href="javascript:void(0);" title="Delete Testing Result" data-id="<?php echo $r1['test_result_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
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
