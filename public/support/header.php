<?php 

	require_once('constent.php'); 

	if(empty($_SESSION['draftdaily']['storage']->user_id) || ($_SESSION['draftdaily']['storage']->role != '2')) {
		header('location:https://draftdaily.com/signup');
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DraftDaily Support</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
		<!-- bootstrap 3.0.2 -->
        <link href="Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!-- font Awesome -->
        <link href="Assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
		<!-- Ionicons -->
        <link href="Assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
       
	   <!-- Morris chart -->
        <link href="Assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
       
       
        <!-- Daterange picker -->
        <link href="Assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        
		 <!-- Bootstrap time Picker -->
        <link href="Assets/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
		
        <!-- Theme style -->
        <link href="Assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />  
		
		<link href="Assets/css/developer.css" rel="stylesheet" type="text/css" />
       
    </head>
	
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="https://draftdaily.com/admin/dashboard" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
              Support Panel
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- Notifications: style can be found in dropdown.less -->
                        
                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        
                    </ul>
					
                </div>
            </nav>
        </header>
		

		