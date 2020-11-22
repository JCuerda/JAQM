<!DOCTYPE html>
<html class="account-pages-bg">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>JAQM - 404</title>

        <!-- App css -->
        <link href="<?php echo base_url('assets/build/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/core.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/components.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/icons.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/pages.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/menu.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/responsive.css');?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12 text-center">

                        <div class="wrapper-page">
                            <img src="assets/images/animat-search-color.gif" alt="" height="120">
                            <h2 class="text-uppercase text-danger">Page Not Found</h2>
                            <p class="text-muted">It's looking like you may have taken a wrong turn. Don't worry... it
                                happens to the best of us. You might want to check your internet connection. Here's a
                                little tip that might help you get back on track.</p>

                            <?php 
                                $url = $url = base_url('home');
                                if($role === 'Applicant') {
                                    $url = base_url('client');    
                                } else if($role === 'Employer') {
                                    $url = base_url('company');  
                                } else if ($role === 'Administrator'){
                                    $url = base_url('administrator');  
                                }
                            ?>

                            <a class="btn btn-success waves-effect waves-light m-t-20" href="<?php echo $url;?>"> Return Home</a>
                        </div>

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/build/js/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/detect.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/fastclick.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.blockUI.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/waves.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.scrollTo.min.js');?>"></script>

        <!-- App js -->
        <script src="<?php echo base_url('assets/build/js/jquery.core.js'); ?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.app.js'); ?>"></script>

    </body>
</html>