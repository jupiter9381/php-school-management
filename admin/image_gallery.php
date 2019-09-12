<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Images</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Images</strong>
                    </span>
                                        
                    <a href="add_image_gallery.php" class="btn btn-info btn-xs pull-right">Add Images</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>                                
                                   
                                    <th>Image</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <div class="masonry-gallery columns-6 clearfix lightbox" data-img-big="3" data-plugin-options='{"delegate": "a", "gallery": {"enabled": true}}'>

                            <a class="image-hover" href="assets/images/demo/1200x800/4-min.jpg">       
                            </div>
                            </tbody>
                              
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
