<?php $__env->startSection('content'); ?>
<!-- Default box -->

	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Add New App</li>
		</ol>
	</section>
<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Add New App</h3>
	</div>
		<!-- /.box-header -->
	<?php echo $__env->make('layouts.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<section class="content"> 
		<form role="form" action="<?php echo e(route('PostAppNew')); ?>" method="post"  enctype="multipart/form-data">
			<?php echo e(csrf_field()); ?>

			<div class="box-body">
				<div class="form-group<?php echo e($errors->has('app_name') ? ' has-error' : ''); ?>">
					<label>App Name </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="app_name" type="text" value="<?php echo e(old('app_name')); ?>" class="form-control" placeholder="Enter app name">
							</div>
						</div>
						  <?php if($errors->has('app_name')): ?>
						<span class="help-block">
							  <strong><?php echo e($errors->first('app_name')); ?></strong>
						</span>
						  <?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('domain_name') ? ' has-error' : ''); ?>">
					<label>Domain Name</label>
						<div class="row">
							<div class="col-xs-6">
								<input name="domain_name" value="<?php echo e(old('domain_name')); ?>" type="text"  class="form-control"   placeholder="Enter domain name">
							</div>
						
						</div>
						  <?php if($errors->has('domain_name')): ?>
						<span class="help-block">
							<strong><?php echo e($errors->first('domain_name')); ?></strong>
						</span>
						  <?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('app_logo') ? ' has-error' : ''); ?>">
					<label>Logo</label>
						 <div class="row">
							  <div class="col-xs-6">
								<input name="app_logo" type="file"  class="form-control" value="<?php echo e(old('app_logo')); ?>" >
							  </div>
						 </div>
				  <?php if($errors->has('app_logo')): ?>
					  <span class="help-block">
						  <strong><?php echo e($errors->first('app_logo')); ?></strong>
					  </span>
				  <?php endif; ?>
				</div>
				
				<div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
					<label>Description</label>
					<div class="row">
						<div class="col-xs-6">
							<textarea id="editor1" name="description" rows="10" cols="80"><?php echo e(old('description')); ?></textarea>   
						</div>
					</div>
					  <?php if($errors->has('description')): ?>
						<span class="help-block">
							<strong><?php echo e($errors->first('description')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>
				  <!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
		</form>
	</section>
		

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>