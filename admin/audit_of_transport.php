<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `audit_of_transport` WHERE `audit_of_transport_id` = '$id'"));
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Audit of transport history</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['audit_of_transport_id'])?'Edit Auditoftransporthistory':'Add Audit of transport history';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddtransportaudit" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Vehicle Number *</label>
                                <div class="fancy-form fancy-form-select">
                                <select class="form-control select2" id="vehicle_number" name="vehicle_number" value="<?php echo isset($data['vehicle_number'])?$data['vehicle_number']:''?>"required>>
                                    <option value="">--Select--</option>
                                    <option value="abc">abc</option>
                                    <option value="xyz">xyz</option>
                                    
                                        


                                        <!-- <option value="<?php //echo $row['member_id']; ?>" <?=$selected; ?>><?php //echo $row['member']; ?></option>> -->
                                    
                                    <?php //}?> 
                                </select>
                                </div>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date *</label>
                                   <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "date" id = "date" title = "Date Required"  value="<?php echo isset($data['date'])?date('d-m-Y',strtotime($data['date'])):'';?>"required>
                                </div>  
                            </div>
                                                   
                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddTransportAudit">
                                        <input type="submit"  id="formvalidate" data-form="formaddtransportaudit"  class="btn btn-info btn-md btn-submit" value="Add Audit">
                                    </div>
                                </div>
                            </div>
                        
                       
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
</section>
<section id="middle">
        <!-- <header id="page-header">
            <h1></h1>
        </header> -->
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Audit of transport history</strong>
                    </span>
                                        
                    <!-- <a href="#" class="btn btn-info btn-xs pull-right">Add Audit of transport history</a> -->
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                                                    
                                    <th>Vehicle Number</th>
                                    <th>Date</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `audit_of_transport`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                        <tr id="invoice<?php echo $r1['SELECT * FROM `audit_of_transport_id'];?>">                                  
                                    
                                    
                                <td><?php echo $r1['vehicle_number']; ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($r1['date'])); ?></td>
                                    <!-- <td><?php //echo $r1['last_name']; ?></td>
                                    <td><?php //echo $r1['mobile_number'];?></td>
                                    <td><?php //echo $r1['email_id']; ?></td>
                                    <td><?php //echo $r1['address']; ?></td>
                                    <td><img src="../upload/<?php //echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                         -->
                            <td>                       
                                
                                <a class="btn btn-xs btn-info" href="audit_of_transport.php?id=<?php echo $r1['audit_of_transport_id'];?>" ><i class="fa fa-edit"></i></a>
                                &nbsp;                         
                               
                                <?php if(permission_access($db,$per_id,'audit_transport_delete')==1){ ?>

                                <a class="btn btn-xs btn-danger DeleteTransportAudit" href="javascript:void(0);" title="Delete transport Audit" data-id="<?php echo $r1['audit_of_transport_id']; ?>"><i class="fa fa-trash"> </i></a>
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
