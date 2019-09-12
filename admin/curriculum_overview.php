<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Curriculum Overview for Academic Class </h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Curriculum Overview for Academic Class</strong>
                    </span>
                                        
                    <a href="add_curriculum_overview.php" class="btn btn-info btn-xs pull-right">Add Curriculum Overview for Academic Class</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                                                      
                                    <th>Curriculum Overview Name</th>
                                    <th>Documents</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `curriculum_overview`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['curriculum_overview_id'];?>">                                  
                                    
                                    
                                <td><?php echo $r1['curriculum_overview_name']; ?></td>
                                
                                <td><a href="../upload/<?php echo $r1['documents'];?>"><i class="fa fa-download"> Download</i> </a></td>
                                <!-- <td><img src="../upload/<?php //echo $r1['documents'];?>" alt="documents" width="100" height="100"></td> -->
                                    
                                <td>                       
                                
                                <a class="btn btn-xs btn-info" href="add_curriculum_overview.php?id=<?php echo $r1['curriculum_overview_id'];?>" ><i class="fa fa-edit"></i></a>
                                &nbsp;                         
                               
                                <?php if(permission_access($db,$per_id,'curriculum_delete')==1){ ?>                        
                               
                                <a class="btn btn-xs btn-danger Deletecurriculumoverview" href="javascript:void(0);" title="Delete Camp Teacher" data-id="<?php echo $r1['curriculum_overview_id']; ?>"><i class="fa fa-trash"> </i></a>
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
