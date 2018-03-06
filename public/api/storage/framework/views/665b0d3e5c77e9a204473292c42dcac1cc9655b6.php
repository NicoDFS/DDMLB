<?php $__env->startSection('content'); ?>

<div class="cen-img"><img src="/images/logo.png" alt="User Image" style="width: 85%;margin: 0 auto;"></div>
<style>
	.cen-img {
    position: absolute;
    width: 394px;
    height: 136px;
    top: 50%;
    left: 50%;
    margin-left: -197px;
    margin-top: -68px;
	text-align: center;
}
  
  </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>