<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_test` WHERE `test_name_id` = '$id'"));

    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Test Name</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['student_test_id'])?'Edit Test Name':'Add Test Name';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddtestname" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Test Name *</label>
                                    <input type="text"  placeholder = "Test Name" class = "form-control" name = "test_name" id = "test_name" title = "Test Name Required"  value="<?php echo isset($data['test_name'])?$data['test_name']:''?>"required>
                                </div>                           
                            
                            

                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Addtestname">
                                        <input type="submit" id="formvalidate" data-form="formaddtestname"  class="btn btn-info btn-md btn-submit"  value="Add Test Name">
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
            <h1>Test Name</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
               

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>                                  
                                    <th>Test Name</th>                                    
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;

                                $q1 = mysqli_query($db, "SELECT * FROM `student_test`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                                {             
                                    $i++;      
                    
                                ?>
                                <tr id="invoice<?php echo $r1['student_test_id'];?>">
                                        
                                    <td><?php echo $r1['test_name_id']; ?></td>
                                    <td><?php echo $r1['test_name']; ?></td>           
                                    <td>                       
                            
                                        <a class="btn btn-xs btn-info" href="student_test_name.php?id=<?php echo $r1['test_name_id'];?>"><i class="fa fa-edit"></i></a>
                                        &nbsp;                         
                                       
                                        <a class="btn btn-xs btn-danger Deletetestname" href="javascript:void(0);" title="Delete Test Name" data-id="<?php echo $r1['test_name_id']; ?>"><i class="fa fa-trash"> </i></a>
                                        &nbsp;                                       
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
