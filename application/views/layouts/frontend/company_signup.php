<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>JAQM - Sign-Up</title>

        <!-- App css -->
        <link href="<?php echo base_url('assets/build/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/core.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/components.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/menu.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert -->
        <link href="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.css');?>" rel="stylesheet" type="text/css">

        <!-- Spin Kit css -->
	    <link href="<?php echo base_url('assets/plugins/SpinKit/spinkit.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/build/css/loader.css');?>" rel="stylesheet" type="text/css" />

        <!-- PNotify -->
        <link href="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.buttons.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.nonblock.css');?>" rel="stylesheet">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url('assets/build/js/modernizr.min.js');?>"></script>

    </head>

    <body class="bg-transparent">
        <div id="loading-screen" hidden="hidden">
			<div class="align-items-center">
				<div class="sk-folding-cube">
					<div class="sk-cube1 sk-cube" style="background-color:white;"></div>
					<div class="sk-cube2 sk-cube" style="background-color:white;"></div>
					<div class="sk-cube4 sk-cube" style="background-color:white;"></div>
					<div class="sk-cube3 sk-cube" style="background-color:white;"></div>
				</div>
			</div>
        </div><!--End of loading screen-->
        
        <div id="normal-loading">
			<div class="align-items-center">
				<div class="sk-folding-cube">
					<div class="sk-cube1 sk-cube" style="background-color:white;"></div>
					<div class="sk-cube2 sk-cube" style="background-color:white;"></div>
					<div class="sk-cube4 sk-cube" style="background-color:white;"></div>
					<div class="sk-cube3 sk-cube" style="background-color:white;"></div>
				</div>
			</div>
		</div><!--End of normal loading screen-->
        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">
                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="index.html" style="color: white; st">
                                            <strong><i class="fa fa-edit"></i> JAQM Sign-Up</strong>
                                        </a>
                                    </h2>
                                </div>
                                <div class="account-content">
                                    <div class="text-center m-b-20">
                                        <div class="m-b-20">
                                            <img src="<?php echo base_url('assets/images/icons/organization.svg"');?>" class="img-circle img-thumbnail thumb-lg" alt="thumbnail">
                                           
                                        </div>
                                        <p class="text-muted m-b-0 font-13">Enter necessary information. </p>
                                    </div>
                                    
                                    <form class="form-horizontal" action="">
                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" id="company_email" name="email" type="email" required="email" placeholder="Company Email">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" id="company_password" name="password" type="password" required="required" placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" id="company_re-password" name="re_pass" type="password" required="required" placeholder="Re-Type Password">
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-danger btn-bordered waves-effect waves-light" type="" id="register-company">Register Company</button>
                                                <!-- <button  class="btn-link" id="paypal-button"></button> -->
                                            </div>
                                        </div>

                                    </form> 

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- end card-box-->
                        </div>
                        <!-- end wrapper -->

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
	    <script src="<?php echo base_url('assets/build/js/global.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.blockUI.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/waves.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.scrollTo.min.js');?>"></script>

        <!-- Sweet-Alert  -->
        <script src="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');?>"></script>
        
        <!-- PNotify -->
        <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.buttons.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.nonblock.js');?>"></script>
        <!-- App js -->
        <script src="<?php echo base_url('assets/build/js/loader.js');?>"></script>

        <!--Paypal-->
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url('assets/build/js/jquery.core.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.app.js');?>"></script>


        <?php if(strlen($script) > 0): ?> 
            <script src="<?php echo $script; ?>"></script>
        <?php endif;?>
    </body>
</html>