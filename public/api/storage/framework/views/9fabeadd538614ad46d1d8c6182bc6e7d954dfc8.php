<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DraftDaily API  | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/dist/css/AdminLTE.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/dist/css/custom-style.css')); ?>">
  <!-- fancybox -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/dist/css/jquery.fancybox.min.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/dist/css/skins/_all-skins.min.css')); ?>">
  
  <!--Ck editor-->
  
   <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/dist/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
   
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/iCheck/flat/blue.css')); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/datatables/dataTables.bootstrap.css')); ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/morris/morris.css')); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/datepicker/datepicker3.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/daterangepicker/daterangepicker.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  
  <!--document page css  -->
  
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/dist/css/prettify.css')); ?>">
 
  <!--  end document page css   -->
  
  <link rel="stylesheet" href="<?php echo e(URL::asset('public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
<!-- jQuery 2.2.3 -->
<script src="<?php echo e(URL::asset('public/assets/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(URL::asset('public/assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="<?php echo e(URL::asset('public/assets/bootstrap/js/bootstrap-confirmation.min.js')); ?>"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php echo $__env->make('layouts.partials._header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Left side column. contains the logo and sidebar -->
    <?php if($action != ''): ?>
        <?php echo $__env->make('layouts.partials._sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
    <?php endif; ?>
  

  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 

    <section class="content">
    
    <?php echo $__env->yieldContent('content'); ?>
    </section>
    </div>
   
  <!-- /.content-wrapper -->
   <?php echo $__env->make('layouts.partials._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
   
</script>


<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!--<script src="<?php echo e(URL::asset('assets/plugins/morris/morris.min.js')); ?>"></script>-->
<!-- Sparkline -->
<script src="<?php echo e(URL::asset('public/assets/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo e(URL::asset('public/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(URL::asset('public/assets/plugins/knob/jquery.knob.js')); ?>"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo e(URL::asset('public/assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>

<!-- DataTables -->
<script src="<?php echo e(URL::asset('public/assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<!-- datepicker -->
<script src="<?php echo e(URL::asset('public/assets/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>


<script src="<?php echo e(URL::asset('public/assets/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>

<script src="<?php echo e(URL::asset('public/assets/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/dist/js/jquery.fancybox.min.js')); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- fancybo -->
<script src="<?php echo e(URL::asset('public/assets/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>

<script src="<?php echo e(URL::asset('public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo e(URL::asset('public/assets/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(URL::asset('public/assets/plugins/fastclick/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(URL::asset('public/assets/dist/js/app.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo e(URL::asset('assets/dist/js/pages/dashboard.js')); ?>"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(URL::asset('public/assets/dist/js/demo.js')); ?>"></script>


<script>
$( document ).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
    $('[data-toggle=confirmation]').confirmation({
		rootSelector: '[data-toggle=confirmation]',
		container: 'body'
	});
	
              
    $("#editor1").wysihtml5();
});
</script>
</body>
</html>
