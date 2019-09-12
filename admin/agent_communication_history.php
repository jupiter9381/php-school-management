<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Agent Communication File</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Agent Communication File</strong>
                    </span>
                                        
                    <a href="add_agent_communication_history.php" class="btn btn-info btn-xs pull-right">Add Agent Communication File</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>File</th>                           
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from agent_communication_history");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><img src="../uploads/<?php echo $r1['upload_file']; ?>" width="50px" height="50px"></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_agent_communication_history.php?id=<?php echo $r1['agent_communication_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'agent_communication_delete')==1){ ?>
                                            
                                            <a class="btn btn-xs btn-danger DeleteAgentCommunication" href="javascript:void(0);" title="DeleteLinked Student" data-id="<?php echo $r1['agent_communication_id']; ?>"><i class="fa fa-trash">Delete</i></a> 

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
