<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `agent_communication_history` WHERE `agent_communication_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Agent Communication File</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['communication_id'])?'Edit Agent Communication File':'Add Agent Communication File';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddagentcammunication" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            
                            <div class="row">
                                 <div class="col-md-6 col-sm-6">
                                    <label>file*</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="upload_file" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['upload_file'])?$data['upload_file']:''?>" required> >
                                        <span class="button">Choose File</span>
                                    </div>
                                </div> 
                            </div>                              
                         
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "agentcommunicationid" id="agentcommunicationid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddAgentCommunicationHistory">
                                    <input type="submit"  id="formvalidate" data-form="formaddagentcammunication"  class="btn btn-info btn-md btn-submit"  value="Add Agent Communication File">
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