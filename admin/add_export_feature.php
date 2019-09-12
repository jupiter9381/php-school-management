<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `export_feature` WHERE `export_feature_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Export Feature for Transport Mgmt Data (PDF)</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit  PDFFile':'Add PDF File';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddexportfeature" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group"> 
                        <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>File Name *</label>
                                    <input type="text"  placeholder = "File Name" class = "form-control" name = "export_feature_name" id = "export_feature_name" title = "File Name Required" value="<?php echo isset($data['export_feature_name'])?$data['export_feature_name']:''?>"required>
                                </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Upload PDF File *</label>
                                         <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="picture" onchange="jQuery(this).next('input').val(this.value);"  accept="image/jpeg, image/png">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly="" value="<?php echo isset($data['documents'])?$data['documents']:''?>" required>
                                        <span class="button">Choose File</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Addexportfeature">
                                        <input type="submit" id="formvalidate" data-form="formaddexportfeature"  class="btn btn-info btn-md btn-submit" value="Add File">
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
<?php include("footer.php"); ?>
