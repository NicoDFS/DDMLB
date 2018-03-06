 
<?php require_once('dd_header.php');

if(empty($_SESSION['draftdaily']['storage']->user_id)) {
	header('location:/signup');
}
 ?>

<div class="container mar-top">
    <div class="row">
		<div class="heading text-center">
			<h1>Support Request</h1>
		</div>
    </div>
</div>

<div class="container margin-40">
    <div class="row">
		<div class="well bg-image-1">
			<div class="tab-content">
				<div class="tab-pane fade in active">
					<div class="row col-container">
						<div class="col-md-12 bg-image-2 download">
							<div class="col-md-8 col-md-offset-2">
								<div style="text-align:center;color:#02f902;" class="row">
									<img src="Assets/img/success.png" style="width:25%;" class="img-circle" alt="Success Image" />
									<br>
									<h2>
										<?php   if(!empty($_SESSION['message_dashboard']))  { echo $_SESSION['message_dashboard']; } ?>
									</h2>
									
								</div><!-- /.row -->
							</div>
						</div>
					</div>          
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("dd_footer.php");?>	

