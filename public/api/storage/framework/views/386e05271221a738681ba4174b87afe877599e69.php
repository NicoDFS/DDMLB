<!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo e(Request::path() == 'about-us' ? 'active' : ''); ?>"><a href="/about-us">About Us</a></li>
            <li class="<?php echo e(Request::path() == 'what-we-do' ? 'active' : ''); ?>"><a href="/what-we-do">What we do</a></li>
              <li class="<?php echo e(Request::path() == 'how-it-works' ? 'active' : ''); ?>"><a  href="/how-it-works">How it works</a></li>
            
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->

<div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            
            <!-- /.messages-menu -->

            
            <!-- Tasks Menu -->
            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu <?php echo e(Request::path() == 'doctor/login' ? 'active' : ''); ?>">
              <!-- Menu Toggle Button -->
              <a href="/doctor/login">                
                <span class="hidden-xs">Login</span>
              </a>
              
            </li>
              <li class="dropdown user user-menu <?php echo e(Request::path() == 'contact-us' ? 'active' : ''); ?>">
              <!-- Menu Toggle Button -->
              <a href="/contact-us">                
                <span class="hidden-xs">Contact Us</span>
              </a>
              
            </li>
           
          </ul>
        </div>