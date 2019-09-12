<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Incident Reports</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Incident Reports</strong>
                    </span>
                                        
                    <a href="add_transport_incident_reports.php" class="btn btn-info btn-xs pull-right">Add Incident Reports</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                                                    
                                    <th>Sn.</th>
                                    <th>Driver Name</th>
                                    <th>Transport Number</th>
                                    <th>Number of Students</th>
                                    <th>Date</th>
                                    <th>Pickup Location</th>
                                    <th>Drop Location</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                           <tbody>
                            <?php
                            $i=1;
                            $q1 = mysqli_query($db, "SELECT * FROM `transport_incident_reports`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                               
                
                                ?>
                            <tr id="invoice<?php echo $r1['transport_incident_reports_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $i++;  ?></td>
                                    <td><?php echo $r1['driver_name']; ?></td>
                                    <td><?php echo $r1['transport_number']; ?></td>
                                    <td><?php echo $r1['students']; ?></td>
                                    
                                    <td><?php echo date('d-m-Y',strtotime($r1['date'])); ?></td>
                                    <td><?php echo $r1['pickup_location']; ?></td>
                                    <td><?php echo $r1['drop_location']; ?></td>
                                    <!-- <td><img src="../upload/<?php //echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                         -->
                      <td>                       
						<?php if($r1['status'] == '0'){?>
						<a href="javascript:void(0);" class="btn btn-xs btn-warning IncedentstatusUpdate" data-id="<?php echo $r1['transport_incident_reports_id'];?>" data-value="1" title="On hold"><i class="fa fa-clock-o"></i></a>
				     	<?php } else 
					     {?>
						<a href="javascript:void(0);" class="btn btn-xs btn-success "  data-value="0" title="Task Completed"><i class="fa fa-check"></i></a>
					    <?php }
					    ?>          
                        <a class="btn btn-xs btn-info" href="add_transport_incident_reports.php?id=<?php echo $r1['transport_incident_reports_id'];?>" ><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <?php if(permission_access($db,$per_id,'transport_incident_report_delete')==1){ ?>
                        <a class="btn btn-xs btn-danger DeleteTransportIncidentReports" href="javascript:void(0);" title="Delete Transport Incident Reports" data-id="<?php echo $r1['transport_incident_reports_id']; ?>"><i class="fa fa-trash"> </i></a>
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
