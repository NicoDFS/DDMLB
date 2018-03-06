<?php $__env->startSection('content'); ?>
	<!-- Default box -->
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Applicaiton List</li>
		<li class="active"> <?php echo e(ucfirst($ApiApps->app_name)); ?></li>
      </ol>
	</section>
	<?php echo $__env->make('layouts.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="box">
		<div class="box-header with-border">
              <h3 class="box-title"><?php echo e(ucfirst($ApiApps->app_name)); ?> Details</h3>
            </div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover" id="">
				<thead>
					<tr>
					  <th>Key</th> 
					  <th>Value</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($ApiApps) > 0): ?>
						
						<tr>
						  <td>App Name</td>
						  <td><?php echo e($ApiApps->app_name); ?></td>			 
						</tr>
						
						<tr>
						  <td>Domain Name</td>
						  <td><?php echo e($ApiApps->domain_name); ?></td>			 
						</tr>
						
						<tr>
						  <td>App Id</td>
						  <td><?php echo e($ApiApps->appId); ?></td>			 
						</tr>
						<tr>
						  <td>SecretID</td>
						  <td><?php echo e($ApiApps->secretId); ?></td>			 
						</tr>
						<tr>
						  <td>Description</td>
						  <td><?php echo $ApiApps->app_desc; ?></td>			 
						</tr>
						<tr>
						  <td>Created</td>
						  <td><?php echo e($ApiApps->created_at); ?></td>			 
						</tr>
						
						<tr>
							<td>Status</td>
							<td>
								<span class="info-box-number">
								  <?php if($ApiApps->status == 1): ?>
									  <span class="label label-success">Live</span>
									<?php elseif($ApiApps->status == 2): ?>
										<span class="label label-warning">Pending</span>
									<?php else: ?>
										<span class="label label-danger">Inactive</span>
									<?php endif; ?>
								</span>
							 </td>		 
						</tr>
						
						<tr>

							<td>App logo</td>
							<?php  
								$path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/'.$ApiApps->id.'/'.$ApiApps->app_logo 
							 ?>
							<td>
								
								<?php if($ApiApps->app_logo): ?>
									<img src="/public/timthumb.php?src=<?php echo e(URL::asset($path)); ?>&w=80&q=90" class="" alt="App image">
								<?php else: ?>
									 <img src="/public/timthumb.php?src=<?php echo e(URL::asset('public/images/No-Image-Basic.png')); ?>&w=80&q=90" class="img-circle" alt="App image">
								<?php endif; ?>
							</td>
						</tr>
					
					<?php else: ?>
						<tr><td colspan="7">No record.</td></tr>
					<?php endif; ?>
					
				</tbody>
		  </table>
		</div>
		<!-- /.box-body -->
	 </div> 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>