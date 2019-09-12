d<?php include "header.php";?>
<section id="middle">
        <header id="page-header">
            <h1>Milestone</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Milestone(gantt_chart)</strong>
                    </span>
                                        
                   
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                  <th>Project Name</th>
                                  <th>Project Discription</th>
                                  <th>Project Member</th>
                                  <th>Gantt_Chart</th>
								 
                                </tr>
                                </thead>

                                <tbody>
                                <?php $qry= mysqli_query($db,"Select t1.*,t2.member from milestone as t1 left join member as t2 on t1.pro_member=t2.member_id ");
                                    $i=1;
                                    while($row= mysqli_fetch_assoc($qry))
                                    {?>
                                <tbody>
                                    <tr>
                                        <td>
                                             <?php echo $i; ?>
                                        </td>
                                        <td>
                                             <?php echo $row['pro_name']; ?>
                                        </td>
                                         <td>
                                             <?php echo $row['pro_des']; ?>
                                        </td>
                                         <td>
                                             <?php echo $row['member']; ?>
                                        </td>
                                         <td>
                                            <a href="../uploads/ganttchart/<?php echo $row['gantt_chart']; ?>">Download</a>                                      </td>
                                        </td>
                                      
                                        
                                    </tr>
                                    
                                    
                                    
                                    
                                </tbody>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
    </div>
    </section>
<?php include "footer.php";?>
