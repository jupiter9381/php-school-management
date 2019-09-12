<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Student Application</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Student Application</strong>
                    </span>
                                        
                    <a href="add_student_app.php" class="btn btn-info btn-xs pull-right">Add Student Application</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>                           
                                    <th>Gender</th>
                                    <th>Date Of birth</th>                            
                                    <th>Nationality</th> 
                                    <th>Status</th>
                                    <th>Download</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                                $i=1;
                                if(permission_access($db,$per_id,'userlist_view')==1){

                                    $q1 = mysqli_query($db,"SELECT * FROM school_application");
                                }

                                else{

                                    $user_id = isset($_SESSION['userLoggedin'])?$_SESSION['userLoggedin']:'';

                                    
                                    if(!empty($user_id)){
                                        $q1 = mysqli_query($db,"SELECT * FROM school_application WHERE uid='$user_id'");
                                    }else{
                                        $q1 = mysqli_query($db,"SELECT * FROM school_application");
                                    }
                                }
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {

                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><a href="add_student_profile.php?id=<?php echo $r1['student_app_id'];?>"><?php echo $r1['student_name']; ?></a></td>
                                        <td><?php echo $r1['gender']; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($r1['dob'])); ?></td>
                                        <td><?php echo $r1['nationality']; ?></td>
                                        <td>
                                            <?php

                                                if($r1['status']==0){

                                                    echo "In Progress";

                                                }elseif($r1['status']==1){

                                                    echo "Completed";

                                                }elseif($r1['status']=2){

                                                    echo "Cancelled";

                                                }
                                            ?>
                                        </td>
                                        <!-- <td><a href="../upload/<?php echo $r1['final_application_form'];?>"><i class="fa fa-print"> Download</i> </a></td> -->

                                        <td>
                                            <a href="camper_application_form.php?id=<?php echo $r1['student_app_id'];?>"><i class="fa fa-download"> Download</i> </a>
                                        </td>
                                        
                                        <td>
                                            <a class="btn btn-xs btn-info" href="add_student_app.php?id=<?php echo $r1['student_app_id'];?>" title="Edit Application Student"><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'student_application_delete')==1){ ?>
                                            <a class="btn btn-xs btn-danger DeleteApplicationStudent" href="javascript:void(0);" title="Delete Application Student" data-id="<?php echo $r1['student_app_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
                                             <?php } ?> 

                                            <?php 
                                            $check_permission = check_permission();
                                            if($check_permission == true){
                                            ?>
                                            <?php if(isset($r1['status']) && $r1['status']==0){?>
                                            <a class="btn btn-xs btn-success MarkAsCompleted" href="javascript:void(0);" title="Complete Application Student" data-id="<?php echo $r1['student_app_id']; ?>"><i class="fa fa-list"> Mark as Complete</i></a>
                                            <?php }else{ echo  ""; }} ?>


                                            <br>
                                            <?php if(isset($r1['status']) && $r1['status']==0){?>
                                            <a class="btn btn-xs btn-danger CancelApplication" href="javascript:void(0);" title="Cancel Application Student" data-id="<?php echo $r1['student_app_id']; ?>"><i class="fa fa-remove"> Mark as Cancel</i></a> 
                                            <?php } ?>
                                            <!--<a class="btn btn-xs btn-primary " href="print_application.php?id=<?php echo $r1['student_app_id'];?>" title="Print Application Student" data-id="<?php echo $r1['student_app_id']; ?>"><i class="fa fa-print"> Print</i></a>--> 
                                            <a class="btn btn-xs btn-success AttendanceModel" data-toggle="modal" data-target="#final_application" data-id="<?php echo $r1['student_app_id']; ?>" onclick="document.getElementById('final_application_id').value=<?php echo $r1['student_app_id']; ?>"><i class="fa fa-file">Upload File</i></a>

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


<div class="modal fade" id="final_application" role="dialog" style="">
    <div class="modal-dialog" style="width:400px;">
      <!-- Modal content-->
        <div class="modal-content" style="width: 400px;height: 200px;text-align: center;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Final Application File Upload</h4>
            </div>
            

            <form action="" id = "formfinalapplication" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label>Upload File *</label>
                            <div class="fancy-file-upload fancy-file-primary">
                                <i class="fa fa-upload"></i>
                                <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);" accept="image/jpeg, image/png">
                                <input type="text" class="form-control" placeholder="No file selected" readonly="" value="<?php echo isset($data['final_application_form'])?$data['final_application_form']:''?>"  required> >
                                <span class="button">Choose File</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 text-center">
                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                        <input type ="hidden" name = "type" value="AddFinalApplicationForm">
                        <input type ="hidden" name = "final_application" id = "final_application_id" value="">
                        <input type="submit"  id="" data-form="formfinalapplication" class="btn btn-info btn-md btn-submit" value="Add File">
                    </div>
                    
                </div>
            </form>

        </div>
      
    </div>
</div>


<?php include("footer.php"); ?>



<script>
    


    

$("#formfinalapplication").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = "after_final_application_upload.php?id="+obj.id;
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});



</script>
