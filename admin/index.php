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

                <!-- login form -->
               <form action="" class="sky-form boxed" id = "loginform1" method="post" enctype="multipart/form-data">
                    <header><i class="fa fa-users"></i> Sign In</header>

                    <fieldset>  
                    
                        <section>
                            <label class="label">Email</label>
                            <label class="input">
                                <i class="icon-append fa fa-envelope"></i>
                                <input type="email" name = "email" required="required">
                                <span class="tooltip tooltip-top-right">Email Address</span>
                            </label>
                        </section>
                        
                        <section>
                            <label class="label">Password</label>
                            <label class="input">
                                <i class="icon-append fa fa-lock"></i>
                                <input type="password" name = "password" required="required">
                                <b class="tooltip tooltip-top-right">Type your Password</b>
                            </label>
                            
                        </section>

                    </fieldset>

                    <footer>
                        <input type ="hidden" name = "type" value="AddNewlogin1">
                            <center>                
                        <input type="submit" title="submit" id="formvalidate" data-form="loginform1"  class="btn btn-info btn-md btn-submit"  value="Log In">
                        </center>
                        <label for="" style = "color: red;font-size:16px;text-center"><?php if(isset($error)) echo $error;?></label>
                        <!--<div class="forgot-password pull-left">
                            <a href="forget_password.php">Forget Password </a> <br />-->
                            <a href="register.php"><b>Need to Register?</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="forgot-password.php"><b>Forgot Password?</b></a>
                        
                        
                    </footer>
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

