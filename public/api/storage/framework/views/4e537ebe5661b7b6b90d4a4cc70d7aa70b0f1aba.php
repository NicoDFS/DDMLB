<!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo e(Request::path() == 'about-us' ? 'active' : ''); ?>"><a href="/about-us">About Us</a></li>
            <li class="<?php echo e(Request::path() == 'dfscoin' ? 'active' : ''); ?>"><a href="/dfscoin">DFSCoin</a></li>
          <!-- <li class="<?php echo e(Request::path() == 'what-we-do' ? 'active' : ''); ?>"><a href="/what-we-do">What we do</a></li>
             <li class="<?php echo e(Request::path() == 'what-we-are' ? 'active' : ''); ?>"><a  href="/what-we-are">What we are</a></li> -->
            <li class="<?php echo e(Request::path() == 'api-details' ? 'active' : ''); ?>"><a  href="/api-details">Documentation</a></li>
          </ul>
          
        </div> 
        <!-- /.navbar-collapse -->

<div class="navbar-custom-menu collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            
            <!-- /.messages-menu -->

            
            <!-- Tasks Menu -->
            <?php if(isset(Auth::guard('appuser')->user()->id)): ?>
            <li class="dropdown user user-menu <?php echo e(Request::path() == 'user/home' ? 'active' : ''); ?>">
              <!-- Menu Toggle Button -->
              <a href="/user/home">                
                <span class="hidden-xs">My Account</span>
              </a>
              
            </li>
            <?php else: ?>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu <?php echo e(Request::path() == 'user/login' ? 'active' : ''); ?>">
              <!-- Menu Toggle Button -->
              <a href="/user/login">                
                <span class="hidden-xs">Login</span>
              </a>
              
            </li>
            
            <li class="dropdown user user-menu <?php echo e(Request::path() == 'user/register' ? 'active' : ''); ?>">
              <!-- Menu Toggle Button -->
              <a href="/user/register">                
                <span class="hidden-xs">Register</span>
              </a>
              
            </li>
           <?php endif; ?>
           <li class="dropdown user user-menu <?php echo e(Request::path() == 'contact-us' ? 'active' : ''); ?>">
              <!-- Menu Toggle Button -->
              <a href="/contact-us">                
                <span class="hidden-xs">Contact Us</span>
            </a>
              
            </li>
          </ul>
        </div>