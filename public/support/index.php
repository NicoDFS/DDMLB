<?php
    session_start();
	
	if(!empty($_SESSION['draftdaily']['storage']->user_id)) {
		header('location:add-request');
	} else {
		header('location:https://draftdaily.com/signup');
	}
		
?>
