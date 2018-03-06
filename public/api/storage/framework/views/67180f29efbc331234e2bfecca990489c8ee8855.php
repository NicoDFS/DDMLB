<?php $__env->startSection('content'); ?>
	<!-- Default box -->
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
    </section>
	
	<div class="box">
		<div class="box-header with-border">
			
		</div>
		<!-- /.box-header -->
		<?php echo $__env->make('layouts.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<section class="content">    		
			<div class="col-lg-3 col-xs-6">
			<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3></h3>
						<p>Total Apps(<?php echo e($apps); ?>)</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
					<a href="<?php echo e(route('AppList')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
				
			</div>		
		</section>     
    </div>
    <!-- /.row -->     
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>