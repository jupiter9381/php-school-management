<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Export Feature for Transport Mgmt Data</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Export Feature</strong>
                    </span>
                                        
                  <a href="add_export_feature.php" class="btn btn-info btn-xs pull-right">Add Export Feature</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                <tr>
                                    							  
                                  <th>Name</th>
                                  <th>Transport Mgmt Data Download</th>
                                  <th>Action</th>
                                  
                                   
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=0;

                                $q1 = mysqli_query($db, "SELECT * FROM `export_feature`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                                $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['export_feature_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['export_feature_name']; ?></td>
                                    <td><a href="../upload/<?php echo $r1['documents'];?>"><i class="fa fa-download"> Download</i> </a></td>
                                        
                                    <td>                       
                                        
                                        <a class="btn btn-xs btn-info" href="add_export_feature.php?id=<?php echo $r1['export_feature_id'];?>" ><i class="fa fa-edit"></i></a>
                                        &nbsp;                         
                                       
                                        <?php if(permission_access($db,$per_id,'export_feature_delete')==1){ ?>
                                        <a class="btn btn-xs btn-danger Deleteexportfeature" href="javascript:void(0);" title="Delete Export Feature" data-id="<?php echo $r1['export_feature_id']; ?>"><i class="fa fa-trash"> </i></a>
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
