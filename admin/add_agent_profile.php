<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `agent_profile` WHERE `agent_profile_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Agent Profile</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Agent Profile':'Add Agent Profile';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddagentprofile" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Agent Name *</label>
                                    <input type="text"  placeholder = "Agent Name" class = "form-control" name = "agent_name" id = "agent_name" title = "Agent Name Required"  value="<?php echo isset($data['agent_name'])?$data['agent_name']:''?>" required>
                                </div>
                           
                                 <div class="col-md-6 col-sm-6 ">
                                    <label>Contact Number *</label>
                                    <input type="text"  placeholder = "Contact Number" class = "form-control" name = "contact_number" id = "contact_number" title = "Contact Number Required"  value="<?php echo isset($data['contact_number'])?$data['contact_number']:''?>" required>
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Address *</label>
                                    <textarea class="form-control" rows="5" name="address" id="address"><?php echo isset($data['address'])?$data['address']:''?></textarea>
                                </div> 
                            </div>
                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "agentid" id="agentid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddAgentProfile">
                                    <input type="submit"  id="formvalidate" data-form="formaddagentprofile"  class="btn btn-info btn-md btn-submit"  value="Add Agent Profile">
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
