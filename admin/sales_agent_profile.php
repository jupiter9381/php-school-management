<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Agent Profile</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Agent Profile</strong>
                    </span>
                                        
                    <a href="add_agent_profile.php" class="btn btn-info btn-xs pull-right">Add Agent Profile</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agent Name</th>                           
                                    <th>Contact Number</th>
                                    <th>Address</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from agent_profile");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['agent_name']; ?></td>
                                        <td><?php echo $r1['contact_number']; ?></td>
                                        <td><?php echo $r1['address']; ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_agent_profile.php?id=<?php echo $r1['agent_profile_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'agent_profile_data_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteAgentProfile" href="javascript:void(0);" title="Delete Agent Profile" data-id="<?php echo $r1['agent_profile_id']; ?>"><i class="fa fa-trash"> Delete</i></a> 

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
