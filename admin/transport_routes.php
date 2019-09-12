<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Transport Routes </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Transport Routes </strong>
                    </span>
                                        
                    <a href="add_transport_route.php" class="btn btn-info btn-xs pull-right">Transport Routes </a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                  <th>Id</th>                            
                                  <th>Pickup Locations </th>
                                  <th>Drop Locations </th>
                                  <th>Route Number </th>
                                  <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT t.*,a.student_pickup FROM transport_routes t LEFT JOIN school_application a ON t.student_app_id=a.student_app_id");

                                


                                while($r1 = mysqli_fetch_assoc($q1)) 

                              
                               { 
                                    if($r1['student_pickup'] == '1'){
                                    $r1['student_pickup'] = 'Danga Bay (Starbucks)';
                                    }
                                    if($r1['student_pickup'] == '2'){
                                    $r1['student_pickup'] = 'Teega A (lobby)';
                                    }
                                    if($r1['student_pickup'] == '3'){
                                    $r1['student_pickup'] = 'Teega B (lobby)';
                                    }
                                    if($r1['student_pickup'] == '4'){
                                    $r1['student_pickup'] = 'Teega Suites (lobby)';
                                    }
                                    if($r1['student_pickup'] == '5'){
                                    $r1['student_pickup'] = 'Mall of medini(lobby)';
                                    } 

                                $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['transport_routes_id'];?>">


                                    
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $r1['student_pickup']; ?></td>
                                    <td><?php echo $r1['drop_locations']; ?></td>
                                    <td><?php echo $r1['route_number']; ?></td>
                                    
                                    <td>                       
                                    
                                            <a class="btn btn-xs btn-info" href="add_transport_route.php?id=<?php echo $r1['transport_routes_id'];?>" ><i class="fa fa-edit"></i></a>
                                    &nbsp;                         
                                   
                                    <?php if(permission_access($db,$per_id,'transport_route_delete')==1){ ?>

                                    <a class="btn btn-xs btn-danger Deletetransportroutes" href="javascript:void(0);" title="Delete Transport Routes" data-id="<?php echo $r1['transport_routes_id']; ?>"><i class="fa fa-trash"> </i></a>
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
