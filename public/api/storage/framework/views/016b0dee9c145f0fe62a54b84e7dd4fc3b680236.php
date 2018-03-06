<header class="main-header">
   
   <!-- Logo -->
    <a href="/" class="logo">
		
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>D</b>D</span>
		
		<!-- logo for regular state and mobile devices -->
		<img alt="logo" class="img-logo-w3 pull-left" id="img-logo-w3" src="<?php echo e(URL::asset('public/images/logo.png')); ?>" style="width:60px;padding-right:5px;margin-top:5px;">
		
		<span class="logo-lg"><b>Draft </b>Daily</span>
    
	</a>
   
	<!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
       
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
			<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">  
						<?php  
						$path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/profile/'.Auth::guard('appuser')->user()->profile_image 
						 ?>
						
						<?php if(Auth::guard('appuser')->user()->profile_image): ?>          
							<img src="/public/timthumb.php?src=<?php echo e(URL::asset($path)); ?>&h=160&w=160&q=90" class="user-image" alt="User image">
						<?php else: ?>
							<img src="/public/timthumb.php?src=<?php echo e(URL::asset('public/assets/dist/img/avatar.png')); ?>&h=160&w=160&q=90" class="user-image" alt="User Image">
						<?php endif; ?>  
						
						<span class="hidden-xs">Mr. <?php echo e(ucfirst(Auth::guard('appuser')->user()->name)); ?></span>
					</a>
					
					<ul class="dropdown-menu">
						
						<!-- User image -->
						<li class="user-header">
							<?php if(Auth::guard('appuser')->user()->profile_image): ?>          
								<img src="/public/timthumb.php?src=<?php echo e(URL::asset($path)); ?>&h=160&w=160&q=90" class="user-image" alt="User image">
							<?php else: ?>
								<img src="/public/timthumb.php?src=<?php echo e(URL::asset('public/assets/dist/img/avatar.png')); ?>&h=160&w=160&q=90" class="user-image" alt="User Image">
							<?php endif; ?>                
							<p>
							Mr.  <?php echo e(Auth::guard('appuser')->user()->name); ?>

							<small>Member since <?php echo e(Auth::guard('appuser')->user()->created_at->format('F Y ')); ?> </small>
							</p>
						</li>
						
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?php echo e(Route('user.profile')); ?>" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo e(Route('user.logout')); ?>" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
						
					</ul>
				</li>
				<!-- Control Sidebar Toggle Button -->
			</ul>
		</div>
    </nav>
</header>