<?php if($errors->any()): ?> 
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Alert!</h4>
			  <?php echo e($errors->first()); ?>

		</div> 
     <?php endif; ?>

<?php if(Session::has('alert-success')): ?>

    <div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		 <?php $__currentLoopData = ['success']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>			<p><?php echo e(Session::get('alert-' . $msg)); ?> </p>
			  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>		   <?php endif; ?>
			 
		
   
