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
    <title>JAQM</title>
    
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

	<!-- Custom box css -->
	<link href="<?php echo base_url('assets/plugins/custombox/css/custombox.min.css'); ?>" rel="stylesheet">

	<!-- Spin Kit css -->
	<link href="<?php echo base_url('assets/plugins/SpinKit/spinkit.css'); ?>" rel="stylesheet">

    <!-- App css -->
    
	<link href="<?php echo base_url('assets/build/css/loader.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/build/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/build/css/core.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/build/css/components.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/build/css/icons.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/build/css/pages.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/build/css/menu.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/build/css/responsive.css');?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/switchery/switchery.min.css');?>">

	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

	<script src="<?php echo base_url('assets/build/js/modernizr.min.js');?>"></script>

</head>


<body class="fixed-left">
	<!-- Begin page -->
	<div id="wrapper" class="forced enlarged">
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
		<!-- Top Bar Start -->
		<?php $this->load->view('layouts/backend/client/topbar');?>
		<!-- Top Bar End -->

		<!-- ========== Left Sidebar Start ========== -->
		<?php $this->load->view('layouts/backend/client/sidebar');?>
		<!-- Left Sidebar End -->

		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<!-- ============================================================== -->
		<div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="page-title-box">
								<h4 class="page-title">
									<?php echo $title; ?>
								</h4>
								<ol class="breadcrumb p-0 m-0">
									<li>
										<a href="#">JAQM</a>
									</li>
									<li class="active">
										<?php echo $title; ?>
									</li>
								</ol>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<!-- end row -->


					<!--CONTENT HERE-->
					<?php if(!empty($location)) $this->load->view($location);?>
				</div> <!-- container -->
			</div> <!-- content -->

			<footer class="footer text-right">
				<?php echo date("Y")?> © JAQM
			</footer>
		</div>

		<!-- ============================================================== -->
		<!-- End Right content here -->
		<!-- ============================================================== -->

		<!-- Right Sidebar -->
		<?php $this->load->view('layouts/backend/client/sidebar');?>
		<!-- /Right-bar -->

	</div>
	<!-- END wrapper -->

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
	<script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js');?>"></script>

	<!-- File System Bootstrap JS -->
	<script src="<?php echo base_url('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js');?>" type="text/javascript"></script>

	<!-- Modal-Effect -->
	<script src="<?php echo base_url('assets/plugins/custombox/js/custombox.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/custombox/js/legacy.min.js'); ?>"></script>

	<!-- Sweet-Alert  -->
    <script src="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');?>"></script>

    <!-- PNotify -->
    <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.buttons.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/pnotify/dist/pnotify.nonblock.js');?>"></script>
    
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

	<!-- App js -->
	<script src="<?php echo base_url('assets/build/js/loader.js');?>"></script>
	<script src="<?php echo base_url('assets/build/js/jquery.core.js');?>"></script>
	<script src="<?php echo base_url('assets/build/js/jquery.app.js');?>"></script>
	<script src="<?php echo base_url('assets/build/js/global.js');?>"></script>

	<!-- Custom JS -->
	<?php  
        if(strlen($script) > 0)
            echo '<script type="text/javascript" src="'.$script.'"></script>';
        else return;
    ?>


</body>

</html>
