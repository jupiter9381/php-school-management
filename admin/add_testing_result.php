<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `testing_result` WHERE `test_result_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Testing Result</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Testing Result':'Add Testing Result';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddtestingresult" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                   <label>Test Number *</label>
                                    <input type="text"  placeholder = "Test 1" class = "form-control" name = "test_number" id = "test_number" title = "Test 1 Required"  value="<?php echo isset($data['test_number'])?$data['test_number']:''?>" required>
                                </div>
                           
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Speaking/Oral Test *</label>
                                    <input type="text"  placeholder = "Speaking/Oral Test" class = "form-control" name = "oral_test" id = "oral_test" title = "Speaking/Oral Test Required"  value="<?php echo isset($data['oral_test'])?$data['oral_test']:''?>" required>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Interview Test *</label>
                                    <input type="text"  placeholder = "Interview Test" class = "form-control" name = "interview_test" id = "interview_test" title = "Interview Test Required"  value="<?php echo isset($data['interview_test'])?$data['interview_test']:''?>" required>
                                </div>
                            </div>                          
                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "testresultid" id="testresultid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddTestingResult">
                                    <input type="submit"  id="formvalidate" data-form="formaddtestingresult"  class="btn btn-info btn-md btn-submit"  value="Add Test Result">
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
