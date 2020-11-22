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
        <title>JAQM - Administrator</title>

        <!-- App css -->
        <link href="<?php echo base_url('assets/build/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/core.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/components.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/menu.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/build/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/fixedHeader.bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/responsive.bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/scroller.bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/dataTables.colVis.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/fixedColumns.dataTables.min.css')?>" rel="stylesheet" type="text/css"/>

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

        <script src="<?php echo base_url('assets/build/assets/build/js/modernizr.min.js');?>"></script>

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="<?php echo base_url('administrator')?>" style="color: white;">
                                            <strong><i class="fa fa-wrench"></i> Administrator</strong>
                                        </a>
                                    </h2>
                                </div>
                                <div class="account-content">
                                    <div class="text-center m-b-20">
                                        <div class="m-b-20">
                                            <img src="<?php echo base_url('assets/images/animat-customize-color.gif');?>" class="img-circle img-thumbnail thumb-lg" alt="thumbnail">
                                            <!-- <i class="fa fa-user-secret fa-5x"></i> -->
                                        </div>
                                        <p class="text-muted m-b-0 font-13">Enter your credentials to access the admin. </p>
                                    </div>
                                    <form class="form-horizontal" action="#" id="login-form">
                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control text-center" id="admin-name" type="text" required="" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control text-center" id="admin-pass" type="password" required="" placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" id="admin-login-btn" type="submit">Log In</button>
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

        <!-- DataTables -->
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.js');?>"></script>

        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.buttons.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/jszip.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/pdfmake.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/vfs_fonts.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/buttons.html5.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/buttons.print.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.fixedHeader.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.keyTable.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.responsive.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/responsive.bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.scroller.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.colVis.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.fixedColumns.min.js');?>"></script>

        <!-- Sweet-Alert  -->
        <script src="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');?>"></script>

        <!-- PNotify -->
        <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.buttons.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.nonblock.js');?>"></script>

        <!-- App js -->
        <script src="<?php echo base_url('assets/build/js/jquery.core.js');?>"></script>
        <script src="<?php echo base_url('assets/build/js/jquery.app.js');?>"></script>

        <?php if(strlen($script) > 0): ?> 
            <script src="<?php echo $script; ?>"></script>
        <?php endif;?>
    </body>
</html>