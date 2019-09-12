
<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title> Admin</title>
        <meta name="description" content="" />
        <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!-- THEME CSS -->
        <link href="../assets/css/essentials.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />

    </head>
    <!--
        .boxed = boxed version
    -->
    <body>


        <div class="padding-15">

            <div class="login-box">
                <div class="panel-heading">
                <h3>Forgot Password</h3>
            </div> <!-- /panel-heading -->

                <!-- login form -->
               <form action="" class="sky-form boxed" id = "formForgotPass" method="post" enctype="multipart/form-data">
                    

                    <fieldset>  
                    
                       <div class="form-group">
                    <label for="inputEmail3" class="control-label">Email Id</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon9"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <input  type="text" class="form-control" id="email" name='email' placeholder="Email Id" data-error="Email Id required" required>
                    </div> <!-- /input-group -->
                    <div class="help-block with-errors"></div>
                </div> <!-- /form-group -->
                <div class="form-group">

                    <input type="hidden" name="type" value="ForgotUserPass">
                   <!--  <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($data['uid'])?$data['uid']:'';?>"> -->
                    <input type="submit" title="submit" id="formvalidate" data-form="formForgotPass"  class="btn btn-info btn-md btn-submit"  value="Submit">
                </div> <!-- /form-group -->


                    </fieldset>

                   
                </form>
            </div>

        </div>

        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = '../assets/plugins/';</script>
        <script type="text/javascript" src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/app.js"></script>
        <script type="text/javascript" src="../includes/adminscript.js"></script>
    </body>
</html>