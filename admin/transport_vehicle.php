<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Transport  Vehicles  </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Transport  Vehicles  </strong>
                    </span>
                                        
                    <a href="add_transport_vehicles.php" class="btn btn-info btn-xs pull-right">Add Transport  Vehicles </a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                                                  
                                    <th>Vehicle  Name</th>
                                    <th>Vehicle Type</th>
                                    <th>Registration Number</th>
                                    <th>Vehicle Number</th>           
                                    <th>Image</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `transport_vehicles`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                                <tr id="invoice<?php echo $r1['transport_vehicles_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['vehicle_name']; ?></td>
                                    <td><?php echo $r1['vehicle_type']; ?></td>
                                    <td><?php echo $r1['registration_number']; ?></td>
                                    <td><?php echo $r1['vehicle_number'];?></td>
                                    <td><img src="../upload/<?php echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                        
                                    <td>                       
                                        
                                        <a class="btn btn-xs btn-info" href="add_transport_vehicles.php?id=<?php echo $r1['transport_vehicles_id'];?>" ><i class="fa fa-edit"></i></a>
                                        &nbsp;                         
                                       
                                        <?php if(permission_access($db,$per_id,'transport_vehicles_delete')==1){ ?>

                                        <a class="btn btn-xs btn-danger DeleteTransportVechicles" href="javascript:void(0);" title="Delete Transport vechicles" data-id="<?php echo $r1['transport_vehicles_id']; ?>"><i class="fa fa-trash"> </i></a>
                                        &nbsp;

                                        <?php }?>
                                      
                                    </td>
                                </tr>
                             <?php }?>
                            
                            </tbody>
                              
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
