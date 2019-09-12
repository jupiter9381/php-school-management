<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `messaging_feature` WHERE `messaging_feature_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Messaging Feature</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Messaging Feature':'Add Messaging Feature';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddmessagingfeature" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                 <div class="col-md-6 col-sm-6 ">
                                    <label>Email  *</label>
                                    <input type="email"  placeholder = "Email" class = "form-control" name = "email" id = "email" title = "Email Required"  value="<?php echo isset($data['email'])?$data['email']:''?>" required>
                                </div>
                            </div>

                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "messagingfeatureid" id="messagingfeatureid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddMessagingFeature">
                                    <input type="submit"  id="formvalidate" data-form="formaddmessagingfeature"  class="btn btn-info btn-md btn-submit"  value="Add Messaging Feature">
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
