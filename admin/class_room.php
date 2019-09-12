<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `class_room` WHERE `class_room_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Class Room</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['class_room_id'])?'Edit ClassRoom':'Add Class Room';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddclassroom" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Class Room Number *</label>
                                    <input type="text"  placeholder = "Class Room Number" class = "form-control" name = "class_room_number" id = "class_room_number" title = "First Name Required"  value="<?php echo isset($data['class_room_number'])?$data['class_room_number']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Building Number *</label>
                                    <input type="text"  placeholder = "Building Number" class = "form-control" name = "building_number" id = "building_number" title = "last Name Required"  value="<?php echo isset($data['building_number'])?$data['building_number']:''?>"required>
                                </div>  
                            </div>
                            
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Addclassroom">
                                        <input type="submit"  id="formvalidate" data-form="formaddclassroom"  class="btn btn-info btn-md btn-submit"  value="Add Class Room">
                                    </div>
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
        <header id="page-header">
            <h1>Class Room</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
               

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>                                  
                                    <th>Class Room Number</th>
                                    <th>Building Number</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `class_room`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['class_room_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['class_room_id']; ?></td>
                                    <td><?php echo $r1['class_room_number']; ?></td>
                                    <td><?php echo $r1['building_number']; ?></td>
                                    
                                        
                      <td>                       
                        
                        <a class="btn btn-xs btn-info" href="class_room.php?id=<?php echo $r1['class_room_id'];?>"><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <?php if(permission_access($db,$per_id,'class_room_delete')==1){ ?>
                        <a class="btn btn-xs btn-danger Deleteclassroom" href="javascript:void(0);" title="Delete Class Room" data-id="<?php echo $r1['class_room_id']; ?>"><i class="fa fa-trash"> </i></a>
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
