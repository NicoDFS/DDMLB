<?php if(!isset($_SESSION)){session_start();} ?>

<!DOCTYPE html>

<html>  
  <head>     
	<meta charset="UTF-8">   
	<title>DraftDaily Support</title>    
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>        	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">	
	<link href="https://fonts.googleapis.com/css?family=Exo+2:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">	
	<link href="../assets/draftdaily/css/bootstrap.min.css" rel="stylesheet" type="text/css"; />
	<link href="../assets/draftdaily/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/draftdaily/css/main.css" rel="stylesheet" type="text/css" />	
	<link href="../assets/draftdaily/css/style.css" rel="stylesheet" type="text/css" />	
	<link href="../assets/draftdaily/css/footable-0.1.css" rel="stylesheet" type="text/css" />	
	<link href="../assets/draftdaily/font/css.css" rel="stylesheet" type="text/css" />	
	<link href="../assets/draftdaily/css/developer.css" rel="stylesheet" type="text/css" />	
	<script src="../assets/draftdaily/js/jquery.min.js" type="text/javascript"></script>
	<script src="../assets/draftdaily/js/bootstrap.min.js" type="text/javascript"></script>	
	<script src="../assets/draftdaily/js/footable-0.1.js" type="text/javascript"></script>	
	<style type="text/css">
		.coinmarketcap-currency-widget img{
			width: 57% !important; 
		}
		div.coinmarketcap-currency-widget > div:first-child{
			background-color:#eee;
		}
	</style>
 
	</head>	

	<body>		
	<div class="draft-daily">			
	<section class="menu-header">				
	<nav class="navbar navbar-inverse navbar-static-top marginBottom-0" role="navigation">					
	<div class="container">						
	<div class="row">   							
	<div class="col-md-2 col-sm-2 col-xs-2 pd-15 logo-1">
	<a class="navbar-brand" href="/"><img src="../assets/draftdaily/img/logo.png" alt="logo.png" /></a>	
	</div>														
	<?php if ($_SESSION['draftdaily']['storage']->user_id) { ?>							
	<center class="text-uppercase display-none-a" style="color:#F5DE50 !important;">Welcome <span class="active"><a style="color:#F5DE50 !important;" href="/account">	
	<?php echo (!empty($_SESSION['draftdaily']['storage']->user_name))? ucfirst($_SESSION['draftdaily']['storage']->user_name) : '';?>		
	</a></span></center>						
	<?php }else{ ?>							
	<center class="text-uppercase display-none-a" style="color:#F5DE50 !important;">Welcome <span class="active">Guest</span></center>
	<?php }?>														<div class="navbar-header navbar-nav-a navbar-nav-ba">
	<button type="button" class="navbar-toggle" data-target="#navbar-collapse-2" id="toggle-b">	
	<span class="sr-only">Toggle navigation</span>									
	<span class="icon-bar"></span>									
	<span class="icon-bar"></span>									
	<span class="icon-bar"></span>								
	</button>							
	</div>														
	<div class="navbar-collapse collapse" id="navbar-collapse-2">
	<div class="col-md-5 col-sm-12 col-xs-12 col-md-offset-1 pd-15">
	<ul class="nav navbar-nav nav-float mr-right-1">										
	<li class="active"><a href="/lineup">My Lineups</a></li>
	<li><a href="/contest">My Contests</a></li>										
	<li class="dropdown hoves">										
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Promotions<b class="caret"></b></a>	
	<ul class="dropdown-menu pull-left setting-icon-width">											
	<?php												
	if (isset($_SESSION['draftdaily']['activePromos'])) {	
	foreach ($_SESSION['draftdaily']['activePromos'] as $promovalue) {	
	echo '<li><a href="/' . $promovalue['promotion_url'] . '">' . $promovalue['promotion_display_name'] . '</a></li>';	
	}												
	} else {	
	echo '<li><a href="#">No Active Promos for Now</a></li>';	
	}												
	?>											
	</ul>										
	</li>									
	</ul>															
	</div>																							
	<div class="col-md-4 col-sm-12 col-xs-12 pd-15">
	<ul class="nav navbar-nav paddingTB-xs bg-dark2 pull-right mr-right-2">	
	<?php if (isset($_SESSION['draftdaily']['storage']->user_id)) { ?>
	<li>												
	<a style="color:#F5DE50 !important;" href="/account">
	<?php echo (!empty($_SESSION['draftdaily']['storage']->user_name))?"Welcome! ".$_SESSION['draftdaily']['storage']->user_name:'';?>	
	</a>											
	</li>											
	<li class="dropdown cus-dropdown">
	<a href="/account" data-toggle="dropdown">DFSCoin: <?php
	if (isset($_SESSION['draftdaily']['storage']->userBalance)) {
		echo $_SESSION['draftdaily']['storage']->userBalance;
		} else {													
		echo '0.00';	
		}												
		?> 
		<b class="caret"></b></a>	
		<ul class="setting-icon-width dropdown-menu pull-right">
		<li><a href="/account"><small>Pending Bonus: <?php	
		if (isset($_SESSION['draftdaily']['storage']->userBonus)) {	
		echo $_SESSION['draftdaily']['storage']->userBonus;		
		} else {	
		echo '0.00';		
		}						
		?></small></a></li>			
		<li><a href="/account"><small>Tickets: <?php	
		if (isset($_SESSION['draftdaily']['storage']->NoOfTickets)) {		
		echo $_SESSION['draftdaily']['storage']->NoOfTickets;			
		} else {	
		echo '0';	
		}			
		?></small></a></li>		
		</ul>				
		</li>				
		<?php }else{ ?>		
		<li><a href="javascript:void(0);" style="color:#F5DE50 !important;">Welcome! Guest</a></li>	
		<li><a class="text-maroon" href="/signup">CREATE AN ACCOUNT</a></li>	
		<li><a href="/login?showmodal=true" class="btn btn-green m-right-sm toggle-c" data-toggle="modal" data-target="#loginModal" id="formvalidatorid">LOGIN</a></li>
		<?php } ?>											
		<li class="dropdown cus-dropdown show-setting-img responsive-img-position">	
		<a data-toggle="dropdown" href="#" class="top10px">	
		<span class="glyphicon glyphicon-cog"></span>
		</a>												
		<ul class="dropdown-menu setting-icon-width pull-right">
		<li><a href="/how-to-play">How-To-Play</a></li>	
		<li><a href="/help/mlb">Contest Rules</a></li>	
		<li><a href="/faq">FAQ</a></li>		
		<?php if ($_SESSION['draftdaily']['storage']->user_id) { ?>			
		<li><a href="/account">My Account</a></li>					
		<li><a href="/refer-friend">Refer-A-Friend</a></li>			
		<?php } ?>													
		<li><a href="/store">FPP Store</a></li>						
		<li><a href="/contact-us">Contact Us</a></li>				
		<li><a href="/support">DraftDaily Support</a></li>			
		<li><a href="/privacy-notice">Privacy-Notice</a></li>		
		<?php if ($_SESSION['draftdaily']['storage']->user_id) { ?>	
		<li class="divider"></li>									
		<li><a href="/logout" style="color:#ff6c00;">Logout</a></li>	
		<?php } ?>												
		</ul>	
		</li>									
		</ul>								
		</div>							
		</div>						
		</div>					
		</div>				
		</nav>					
		<div class="row menu-bg" style="margin:0px;">
		<div class="col-md-5 col-sm-5 col-xs-6 pd-15">
		<div class="menu-bg">
		<ul class="nav navbar-nav pull-right display-none-res">	
		<li class="facebook"><a target="_blank" href="https://www.facebook.com/draftdaily" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook fa-lg"></i></a></li>
		<li class="twitter"><a target="_blank" href="https://twitter.com/dfscoin" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter fa-lg"></i></a></li>
		<li class="reddit"><a target="_blank" href="https://www.reddit.com/r/DFScoin" data-toggle="tooltip" title="reddit"><i class="fa fa-reddit"></i></a></li>
		<li class="github"><a target="_blank" href="https://github.com/NicoDFS/DFSCoin" data-toggle="tooltip" title="github"><i class="fa fa-github"></i></a></li>	
		<li class="slack"><a target="_blank" href="https://dfscoin.slack.com" data-toggle="tooltip" title="slack"><i class="fa fa-slack"></i></a></li>
		<li class="instagram"><a target="_blank" href="https://www.instagram.com/DFSCoin/" data-toggle="tooltip" title="instagram"><i class="fa fa-instagram"></i></a></li>
		<li> <img src="../assets/draftdaily/img/bg.png" alt="bg.png" /></li>
		</ul>
		</div>
		</div>
		<div class="col-md-7 col-sm-7 col-xs-6 pd-15">
		<div class="menu-bg-1">	
		<nav class="navbar navbar-inverse navbar-static-top marginBottom-0" role="navigation" style="background:#1385fe;z-index:auto;">
		<div class="navbar-header navbar-nav-a navbar-nav-bac">
		<button type="button" class="navbar-toggle" id="toggle-a" data-target="#navbar-collapse-1">	
		<span class="sr-only">Toggle navigation</span>										
		<span class="icon-bar"></span>										
		<span class="icon-bar"></span>										
		<span class="icon-bar"></span>									
		</button>								
		</div>																
		<div class="navbar-collapse collapse" id="navbar-collapse-1">
		<ul class="nav navbar-nav pull-right mr-right">
		<li><a href="/home">LOBBY</a></li>										
		<li><a href="add-request">ADD NEW REQUEST</a></li>	
		<li><a href="track-request">TRACK YOUR REQUEST</a></li>	
		</ul>								
		</div>							
		</nav>						
		</div>					
		</div>				
		</div>			
		</section>    
		<script>	
		$(document).ready(function(){
			/**/		
			$("#toggle-b").click(function(){
				$("#navbar-collapse-1").slideUp(500);
				$("#navbar-collapse-2").slideToggle('slow');
				});				
				$("#toggle-a").click(function(){
					$("#navbar-collapse-2").slideUp(500);
					$("#navbar-collapse-1").slideToggle('slow');		
					});				$(".toggle-c").click(function(){
						$("#navbar-collapse-2").slideUp();			
						$("#navbar-collapse-1").slideUp();		
						});			
						});			
						</script>
						