<?php include("header.php");
 if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `users` WHERE `uid` = '$id'"));
    }

 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>User</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['uid'])?'Edit User':'Add User';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formadduser" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text"  placeholder = "First Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>" required>
                                </div>
								
                                <div class="col-md-6 col-sm-6">
                                    <label>Last Name</label>
                                    <input type="text"  placeholder = "Last Name" class = "form-control" name = "last_name" id = "last_name" title = "Last Name Required"  value="<?php echo isset($data['last_name'])?$data['last_name']:''?>" required>
                                </div>
							</div>
						</div>
						<div class="row">
                            <div class="form-group">

                                <div class="col-md-6 col-sm-6">
                                    <label>Email Id *</label>
                                    <input type="email"  placeholder = "Email" class = "form-control"  id = "email" title = "Email"  value="<?php echo isset($data['email'])?$data['email']:''?>" <?php echo isset($data)?'readonly':'name = "email"'; ?> required>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Contact Number</label>
                                    <input type="text"  placeholder = "Contact number"  pattern="^[A-Za-z0-9_]{1,15}$" class = "form-control" name = "contact_number" id = "contact_number" title = "Contact number"  value="<?php echo isset($data['contact_number'])?$data['contact_number']:''?>"  >
                                </div> 
                                 <div class="clearfix"></div>
								 </br>
                            </div>
                        </div>						   
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($data['uid'])?$data['uid']:'';?>">
                                    <input type ="hidden" name = "type" value="AddUser">
                                    <input type="submit"  id="formvalidate" data-form="formadduser"  class="btn btn-info btn-md btn-submit"  value="<?php echo isset($data['uid'])?'Update User':'Add User';?>">
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
