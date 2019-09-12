<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Boarding Room</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Boarding Room</strong>
                    </span>
                                        
                    <a href="add_boarding_room.php" class="btn btn-info btn-xs pull-right">Add Boarding Room</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Boarding Room Number</th>                           
                                    <th>Floor Number</th>
                                    <th>Buiding Number</th>
                                    <th>Boarding Staff</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT t1. *, t2.first_name from boarding_room as t1 join boarding_staff as t2 on t1.boarding_staff_id=t2.boarding_staff_id ");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['boarding_room_number'];; ?></td>
                                        <td><?php echo $r1['floor_number'];; ?></td>
                                        <td><?php echo $r1['buiding_number'];; ?></td>
                                        <td><?php echo $r1['first_name'];; ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_boarding_room.php?id=<?php echo $r1['boarding_room_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'boarding_room_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteBoadingRoom" href="javascript:void(0);" title="Delete Camp Fee" data-id="<?php echo $r1['boarding_room_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
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
