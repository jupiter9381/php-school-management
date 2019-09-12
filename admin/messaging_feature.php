<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Messaging Feature</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Messaging Feature</strong>
                    </span>
                                        
                    <a href="add_messaging_feature.php" class="btn btn-info btn-xs pull-right">Add Messaging Feature</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>                
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT * from messaging_feature");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['email']; ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_messaging_feature.php?id=<?php echo $r1['messaging_feature_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'messaging_feature_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteMessagingFeature" href="javascript:void(0);" title="Delete Messaging Feature" data-id="<?php echo $r1['messaging_feature_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
                                            
                                        <?php }?>
                                            
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
