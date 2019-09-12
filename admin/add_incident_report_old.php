<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `incident_report` WHERE `incident_report_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Incident Report</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Incident Report':'Add Incident Report';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddincidentreport" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                           <div class="row">
                                 <div class="col-md-6 col-sm-6">
                                    <label>File *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="incident_file" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['incident_file'])?$data['incident_file']:''?>" required> >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Message Box *</label>
                                    <textarea class="form-control" rows="5" name="message_box" id="message_box" required><?php echo isset($data['message_box'])?$data['message_box']:''?></textarea>
                                </div>
                            </div>                              
                           
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "reportid" id="reportid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddIncidentReport">
                                    <input type="submit"  id="formvalidate" data-form="formaddincidentreport"  class="btn btn-info btn-md btn-submit"  value="Add Incident Report">
                                </div>
                            
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
</section>
<?php include("footer.php"); ?>
