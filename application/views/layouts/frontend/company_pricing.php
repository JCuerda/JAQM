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
        <title>JAQM - Subscription</title>

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
    <body>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
            <!-- Start content -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                           
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="<?php echo base_url('login');?>">JAQM</a>
                                </li>
                                <li class="active">
                                    Company Subscription Rate
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-9 center-page">
                        <div class="text-center">
                            <h3 class="m-b-30 m-t-20">Choose your perfect Subscription Plan</h3>
                            <p>
                                JAQM Subscription Details
                            </p>
                        </div>
                        <div class="row m-t-50">
                            <?php $i = 1; foreach($rates as $rate):?>
                                <?php if($rate->id != 9): ?>
                                <article class="pricing-column col-lg-4 col-md-4">
                                    <div class="inner-box card-box">
                                        <div class="plan-header text-center">
                                            <h3 class="plan-title"><?php echo $rate->description.' '.'Subscription';?></h3>
                                            <h2 class="plan-price"><?php echo '$ '.$rate->pricing;?></h2>
                                            <div class="plan-duration"><strong><?php echo $rate->description?></strong></div>
                                        </div>
                                        <ul class="plan-stats list-unstyled text-center">
                                            <li>Maximum of <?php echo $rate->max_post; ?> post allowerd</li>
                                            
                                        </ul>
                                        <div class="text-center">
                                            <button id="process-subscription-<?php echo $i; $i++;?>" data-rate-type="<?php echo $rate->id;?>" data-rate-price="<?php echo $rate->pricing;?>" class="btn-link waves-effect waves-light"></button>
                                        </div>
                                    </div>
                                </article>
                                <?php endif;?>
                            <?php endforeach;?>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
                
            </div> <!-- container -->
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/build/js/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/global.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/detect.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/fastclick.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.blockUI.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/waves.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.scrollTo.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js');?>"></script>
        <!--Paypal-->
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url('assets/build/js/jquery.core.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.app.js');?>"></script>
        
        <!-- Custom JS -->
        <?php  
            if(strlen($script) > 0)
                echo '<script type="text/javascript" src="'.$script.'"></script>';
            else return;
        ?>
    </body>
</html>