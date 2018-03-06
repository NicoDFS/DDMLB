<?php $__env->startSection('content'); ?>
<!-- Default box -->
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Edit Profile</li>
		</ol>
	</section>
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Profile</h3>
		</div>
		<!-- /.box-header -->
		<?php echo $__env->make('layouts.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<section class="content"> 
			<form role="form" action="<?php echo e(route('user.profile')); ?>" method="post"  enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				
				<div class="box-body">
				
					<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label>Name </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="name" type="text" value="<?php echo e($AppUser->name); ?>" class="form-control" placeholder="Enter app name">
							</div>
						</div>
						<?php if($errors->has('name')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('name')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
					
					<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
						 <label>Email</label>
						<div class="row">
							<div class="col-xs-6">
								<input name="email" value="<?php echo e($AppUser->email); ?>" type="text"  class="form-control" disabled>
							</div>						
						</div>						 
					</div>
					
						
					<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
						<label>Password </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="password" type="password" class="form-control" >
							</div>
						</div>
						<?php if($errors->has('password')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('password')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
					
					<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
						<label>Confirm Password </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="password_confirmation" type="password"  class="form-control" >
							</div>
						</div>
					</div>
					<div class="form-group">
							<div class="row">
								<div class="col-xs-6">
									<?php  
									$path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/profile/'.Auth::guard('appuser')->user()->profile_image 
									 ?>
									<span class="info-box-icon2 ">
										<?php if(Auth::guard('appuser')->user()->profile_image): ?> 
										<img src="/public/timthumb.php?src=<?php echo e(URL::asset($path)); ?>&h=160&w=160&q=90" class="img-circle" width="80px"alt="User image">
										<?php else: ?>
										 <img src="/public/timthumb.php?src=<?php echo e(URL::asset($path)); ?>&h=160&w=160&q=90" class="img-circle" alt="User image">
										<?php endif; ?>
									</span>
								</div>
							</div>
						</div> 	
					<div class="form-group<?php echo e($errors->has('profile_image') ? ' has-error' : ''); ?>">
						<label>Profile Image</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="profile_image" type="file"  class="form-control" value="<?php echo e(old('profile_image')); ?>" >
								</div>
							</div>
						<?php if($errors->has('profile_image')): ?>
						<span class="help-block">
						  <strong><?php echo e($errors->first('profile_image')); ?></strong>
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