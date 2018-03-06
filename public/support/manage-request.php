<?php
    include('function.php');
	
	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		try{
			
			$sql="select * from `support_requests` where `id`='$id'";
			$result=mysqli_query($conn,$sql);
			
			if($result){
				$request_data = mysqli_fetch_array($result,MYSQLI_ASSOC);
			}
			
			$sql1="select * from `support_chats` where `request_id`='$id'";
			$result2=mysqli_query($conn,$sql1);
			
			if($result2){
				$chat_messages = mysqli_fetch_all($result2,MYSQLI_ASSOC);
				//echo "<pre>";print_r($chat_messages);die;
			}
		}catch(Exeption $e){
			
		}
	}
	
	if(isset($_POST['submit'])){
		
		if(!empty($_POST)){
			$data=editRequest($_POST,$conn);
	    }
		
    }
	
	
	if(isset($_POST['send'])){
		
		if(!empty($_POST)){
			$data=addChat($_POST,$conn);
		}	//echo "<pre>";print_r($_POST);die;
    }
	
    
?>
<?php require_once('header.php'); ?>
<div class="wrapper row-offconvas row-offcanvas-left">
		<!-- Right side column. Contains the navbar and content of the page -->
		<?php require_once('sidebar.php'); ?> 
	<aside class="right-side">
		<section class="content-header">
			<h1>
				Manage Request
					<small>manage request</small>
			</h1>			
			
			<?php if(!empty($_SESSION['message']))  { ?>	

			<span style="color:green; margin-left:40%;"><b><?php echo $_SESSION['message'];?></b></span>			
			
			<?php  } $_SESSION['message']='';?>		


			<?php if(!empty($_SESSION['error_msg']))  { ?>		

			<span style="color:red; margin-left:40%;"><b><?php echo $_SESSION['error_msg']; ?></b></span><?php }

			$_SESSION['error_msg']='';?>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						 
						</div>
						<?php if(!empty($request_data)):  ?>
					<!-- /.box-header -->
						<div class="box-body" >
							<form action="" method="post" >
								<input name="id" value="<?php echo (!empty($request_data['id']))?$request_data['id']:'';    ?>" type="hidden">

								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Key</th>
											<th>Value</th> 
										</tr>
									</thead>
									<tbody>
										
										<tr>
											<td>RequestId</td>
											<td><?php echo ($request_data['request_id']);?></td>
										</tr>
										
										<tr>
											<td>User name</td>
											<td><?php echo ucfirst($request_data['name']);?></td>
										</tr>
										<tr>
											<td>Email Address</td>
											<td><?php echo $request_data['email'];?></td>
										</tr>
										<tr>
											<td>File</td>
											<?php if(!empty($request_data['file'])) {?>
											<td>
											<a href="download.php?filename=<?php echo $request_data['file'];?>"> <?php echo $request_data['file']; ?>  </a> 
											</td>
											<?php } else { ?>
											<td>
												N/A
											</td>
											<?php } ?>
										</tr>
										<tr>
											<td>Query Message</td>
											<td><textarea rows="4" class="input_width" readonly><?php echo $request_data['message'];?></textarea></td>
										</tr>
										
										<tr>
											<td>Status</td>
											<td>
												<div class="form-group">
												
													<select class="form-control input_width" name="status" >
														<option <?php if(isset($request_data['status']) && ($request_data['status']=='Pending')){ echo "selected"; } ?> value="pending">Pending</option> 
													
														<option value="progress" <?php if(isset($request_data['status']) && ($request_data['status']=='progress')){ echo "selected"; } ?>>Progress</option>
													
														<option value="completed" <?php if(isset($request_data['status']) && ($request_data['status']=='completed')){ echo "selected"; } ?>>Completed</option>
													
													</select> 
												
												</div>
											</td>
										</tr>
										<tr>
											<td></td>
											<td><button type="submit" name="submit" class="btn btn-primary">submit</button></td>
										</tr>
										
									</tbody>
							
								</table>
							</form>
							<?php if(!empty($chat_messages)) : foreach($chat_messages as $message) :?>
							<div class="col-md-12 col-sm-12 custom_margin">
								<div class="col-md-3 col-sm-3 text_align_right">
									<!--<span><b><?php echo ($message['send_by']==1)?"Support team":"You";?></b></span>-->
									<?php if($message['send_by']==1){ ?>
									<span style="color:green"><b>Support team:</b></span>
									<?php }else{ ?>
									<span style="color:brown" ><b>User:</b></span>
									<?php } ?>	

								</div>
								
								<div class="col-md-7 col-sm-7 w3-container w3-border w3-round-xlarge">
									<p><?php echo $message['chat_message'];?></p>
								</div>
							</div>
							<?php endforeach; endif; ?>
							<form name="" action="" method="post">
								<input name="id" value="<?php echo (!empty($request_data['id']))?$request_data['id']:'';    ?>" type="hidden">
								
								<input name="sendby" value="1" type="hidden">
								<div class="col-md-12 col-sm-12 custom_margin">
									<div class="col-md-3 col-sm-3 text_align_right">
										<span>Send Message</span>
									</div>
									<div class="col-md-9 col-sm-9">
										
										<textarea name="chat_message" rows="4" class="input_width" ></textarea><br>
										<span style="color:red"><?php if(!empty($data['error']['chat_message'])){ echo $data['error']['chat_message'];} ?></span>
									</div>
									
								</div>
								<div class="col-md-12 col-sm-12 custom_margin">
									<div class="col-md-3 col-sm-3 text_align_right">
										
									</div>
									<div class="col-md-9 col-sm-9">
										<div class="box-footer">
											<button type="submit" name="send" class="btn btn-primary">Send Message</button>
										</div>
									</div>
								</div>
							</form>
						
						</div>
						<?php endif ?>
						<!-- /.box-body -->
					</div>
					  <!-- /.box -->
				</div>
					<!-- /.col -->
			</div>
				  <!-- /.row -->
		</section>
			   <!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->


<!-- add new calendar event modal -->
<?php require_once("footer.php");?>
<script>
 $(document).ready(function(){
	 $('#treeview2').addClass('active');
	 $('#sub-menu-2-1').addClass('active');
	 $('#treeview-menu2').addClass('active');
	 $('#treeview-menu2').attr("style","display: block;");
 });
</script>