<style>
#scrollable-ul{
	height:300px;
	overflow-y:scroll;
}
#scrollable-ul::-webkit-scrollbar {
    width: 0.3em;
}
 
#scrollable-ul::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
 
#scrollable-ul::-webkit-scrollbar-thumb {
  background-color: #8aa4af;
  outline: 1px solid slategrey;
}
</style>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
			@php 
			$path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/profile/'.Auth::guard('appuser')->user()->profile_image 
			@endphp
			
			@if(Auth::guard('appuser')->user()->profile_image)          
				<img src="/public/timthumb.php?src={{ URL::asset($path) }}&h=160&w=160&q=90" class="user-image" alt="User image">
			@else
				<img src="/public/timthumb.php?src={{ URL::asset('public/assets/dist/img/avatar.png') }}&h=160&w=160&q=90" class="user-image" alt="User Image">
			@endif  
          
        </div>
        <div class="pull-left info">
          <p>Mr.  {{Auth::guard('appuser')->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="/user/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
        </li>
		
        <li class="treeview {{ Request::path() == 'user/application' || Request::path() == 'user/new-app'  || (Request::is('user/view-app/*')) || (Request::is('user/edit-App/*')) ? 'active' : '' }}">
          <a href="#"> 
            <i class="fa fa-folder"></i> <span>Applications</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
            <li class="{{ Request::path() == 'user/application'||(Request::is('user/view-app/*'))||(Request::is('user/edit-App/*'))  ? 'active' : '' }}">
                <a href="/user/application"><i class="fa fa-circle-o"></i>Application List</a></li>
                <li class="{{ Request::path() == 'user/new-app' ? 'active' : '' }}">
                <a href="/user/new-app"><i class="fa fa-circle-o"></i>Create New App</a></li>
          </ul>
        </li> 
        
        <li class="treeview {{ Request::path() == 'user/documentation' ? 'active' : '' }}">
          <a href="javascript:void(0);">
            <i class="fa fa-folder"></i> <span>API Documentation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
			<ul class="treeview-menu" id="scrollable-ul">
				<li class="api-treeview"><a href="/user/documentation#getstarted"><i class="fa fa-circle-o"></i>Get started</a></li>
				
				<li class="api-treeview"><a href="/user/documentation#auth"><i class="fa fa-circle-o"></i>Auth</a></li>
				
				<li class="api-treeview"><a href="/user/documentation#get-country-list"><i class="fa fa-circle-o"></i>Get-country-list</a></li>
				
				<li class="api-treeview"><a href="/user/documentation#get-state-list"><i class="fa fa-circle-o"></i>Get-state-list</a></li>
				
				<li class="api-treeview"><a href="/user/documentation#register"><i class="fa fa-circle-o"></i>Register-account</a></li>

				<li class="api-treeview"><a href="/user/documentation#login"><i class="fa fa-circle-o"></i>User-login</a></li>
				
				<li class="api-treeview"><a href="/user/documentation#user-logout"><i class="fa fa-circle-o"></i>User-logout</a></li>
				
				<li class="api-treeview"><a href="/user/documentation#get-user-account-detail"><i class="fa fa-circle-o"></i>Get-user-account-detail</a></li>
				<li class="api-treeview"><a href="/user/documentation#get-sports"><i class="fa fa-circle-o"></i>Get-sports</a></li>
				<li class="api-treeview"><a href="/user/documentation#get-contest-type"><i class="fa fa-circle-o"></i>Get-contest-type</a></li>
				<li class="api-treeview"><a href="/user/documentation#get-matches"><i class="fa fa-circle-o"></i>Get-matches</a></li>
				<li class="api-treeview"><a href="/user/documentation#create-new-contest"><i class="fa fa-circle-o"></i>Create-new-contest</a></li>
				<li class="api-treeview"><a href="/user/documentation#get-contest"><i class="fa fa-circle-o"></i>Get-contest</a></li>
				<li class="api-treeview"><a href="/user/documentation#get-filter-player"><i class="fa fa-circle-o"></i>Get-filter-player</a></li>
				<li class="api-treeview"><a href="/user/documentation#new-lineup"><i class="fa fa-circle-o"></i>New-lineup</a></li>
				<li class="api-treeview"><a href="/user/documentation#edit-lineup"><i class="fa fa-circle-o"></i>Edit-lineup</a></li>
				<li class="api-treeview"><a href="/user/documentation#get-lineup-details"><i class="fa fa-circle-o"></i>Get-lineup-details</a></li>
				<li class="api-treeview"><a href="/user/documentation#remove-player"><i class="fa fa-circle-o"></i>Remove-player</a></li>
				<li class="api-treeview"><a href="/user/documentation#add-player"><i class="fa fa-circle-o"></i>Add-player</a></li>
				<li class="api-treeview"><a href="/user/documentation#get-applicable-match"><i class="fa fa-circle-o"></i>Get-applicable-match</a></li>
				
			</ul>
        </li>
        
        
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>
	<script>
	$(document).ready(function(){
		$('.api-treeview').click(function(){
			$('.api-treeview').removeClass('active');
			$(this).addClass('active');
		});
	});
	</script>