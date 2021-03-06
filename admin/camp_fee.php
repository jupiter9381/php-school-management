<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Camp Fee / Cost Assignment</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Camp Fee / Cost Assignment</strong>
                    </span>
                                        
                    <a href="add_camp_fee.php" class="btn btn-info btn-xs pull-right">Add Camp Fee / Cost Assignment</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Camp Name</th>
                                    <th>Camp Fee</th>                           
                                    <th>Transport fee</th>
                                    <th>Activity fee</th>
                                    <th>Notes</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT t1.*,t2.camp_name from camp_fee as t1 join  camp_management as t2 on t1.camp_name=t2.camp_name");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['camp_name']; ?></td>
                                        <td><?php echo $r1['camp_fee'];; ?></td>
                                        <td><?php echo $r1['transport_fee'];; ?></td>
                                        <td><?php echo $r1['activity_fee'];; ?></td>
                                        <td><?php echo $r1['camp_notes'];; ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_camp_fee.php?id=<?php echo $r1['camp_fee_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'camp_fee_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteCampFee" href="javascript:void(0);" title="Delete Camp Fee" data-id="<?php echo $r1['camp_fee_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
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
