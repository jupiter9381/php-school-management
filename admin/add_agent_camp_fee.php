<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `agent_camp_fee` WHERE `agent_camp_fee_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Agent Camp Fee/Cost Assignment</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Agent Camp Fee/Cost Assignment':'Add Agent Camp Fee/Cost Assignment';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddagentcampfee" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Camp Fee *</label>
                                    <input type="text" class="form-control" name="camp_fee" id="camp_fee" value="<?php echo isset($data['camp_fee'])?$data['camp_fee']:''?>">
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Transport Fee *</label>
                                    <input type="text" class="form-control" name="transport_fee" id="transport_fee" value="<?php echo isset($data['transport_fee'])?$data['transport_fee']:''?>">
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Activity Fee *</label>
                                    <input type="text" class="form-control" name="activity_fee" id="activity_fee" value="<?php echo isset($data['activity_fee'])?$data['activity_fee']:''?>">
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Notes *</label>
                                    <input type="text" class="form-control" name="camp_notes" id="camp_notes" value="<?php echo isset($data['camp_notes'])?$data['camp_notes']:''?>">
                                </div>
                            </div>                              
                           
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "agentcampid" id=agentcampid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddAgentCampFee">
                                    <input type="submit"  id="formvalidate" data-form="formaddagentcampfee"  class="btn btn-info btn-md btn-submit"  value="Add Agent Camp Fee">
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
