<?php
    include('function.php');
	
	if(empty($_SESSION['draftdaily']['storage']->user_id)) {
		header('location:/signup');
	}
	
	if(!empty($_GET['request_id'])){
		$id=$_GET['request_id'];
		try{
			
			$sql="select * from `support_requests` where `request_id`='$id'";
			$result=mysqli_query($conn,$sql);
			
			if($result){
				$r_data = mysqli_fetch_array($result,MYSQLI_ASSOC);
				
			}
			
			if(!empty($r_data['id'])){
				$r_id = $r_data['id'];
				$sql1="select * from `support_chats` where `request_id`='$r_id'";
				$result2=mysqli_query($conn,$sql1);
				
				if($result2){
					$chat_messages = mysqli_fetch_all($result2,MYSQLI_ASSOC);
					//echo "<pre>";print_r($chat_messages);die;
				}
			}
			
		}catch(Exeption $e){
			
		}
	}
	
	if(isset($_POST['send'])){
		
		if(!empty($_POST)){
			$data=addChat($_POST,$conn);
		}	
    }
	
    
?>

<?php require_once('dd_header.php'); ?>

<div class="container margin-40 mar-top">
<div class="heading text-center">
<h1 id="head-line">Your Request Status</h1>
</div>
    <div class="row">
        <div class="well bg-image-1">
        <div class="bg-image-2">
		<div class="m-top-sm">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-2">
                                   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 m-bottom-sm">
                        <div class="">
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <div>
                                       <section class="content">
											<div class="box box-primary">
																	
												<!-- form start -->
												<form action="" method="get" enctype="multipart/form-data" >
													
														<br>
														<br>
														<div style="margin-left:25%;" class="col-md-6 col-sm-6 input-group input-group-lg">
															<input type="text" autocomplete="off" name="request_id" value="<?php echo (!empty($_GET['request_id']))?$_GET['request_id']:''; ?>" placeholder="Enter Your Request ID" class="form-control">
															<span class="input-group-btn">
																<button class="btn btn-info btn-flat" type="submit">Search</button>
															</span>
														</div>
														<br>
														<br>
												</form>
												
																
												<?php if(!empty($r_data)){ ?>
												
												<table class="table text-white table-bordered">
													
													<tbody>
													
														<tr class="bg-white">
															<td class="bg-width">RequestId</td>
															<td><?php echo ($r_data['request_id']);?></td>
														</tr>
														
														<tr class="bg-white">
															<td class="bg-width">User name</td>
															<td><?php echo ucfirst($r_data['name']);?></td>
														</tr>
														<tr class="bg-white">
															<td class="bg-width">Email Address</td>
															<td><?php echo $r_data['email'];?></td>
														</tr>
														<tr class="bg-white">
															<td class="bg-width">File</td>
															<?php if(!empty($r_data['file'])) {?>
															<td>
																<a href="download.php?filename=<?php echo $r_data['file'];?>"> <?php echo $r_data['file']; ?>  </a> 
															</td>
															<?php } else { ?>
															<td>
																N/A
															</td>
															<?php } ?>
														</tr>
														<tr class="bg-white">
															<td class="bg-width">Query Message</td>
															<td><p><?php echo $r_data['message'];?></p></td>
														</tr>
															
														<tr class="bg-white">
															<td class="bg-width">Status</td>
															<td style="color:<?php echo ($r_data['status']=='pending')?'red':(($r_data['status']=='progress')?'maroon':'green'); ?>"><?php echo ucfirst($r_data['status']); ?>
															</td>
														</tr>
														
														
													</tbody>
												
												</table>
												<?php if(!empty($chat_messages)) { ?>
												<div class="row scroll-y mr-15-right-left">
													
													<?php	foreach($chat_messages as $message) { ?>
													
												
													<div class="col-md-12 col-sm-12 custom_margin bg-white">
														<div class="col-md-12 col-sm-12 pull-left margin-20">
														<?php if($message['send_by']==1){ ?>
														<div class="col-md-2 col-sm-2">
															<span style="color:brown"><b class="pull-right">Support team</b></span></div>
															<div class="col-md-7 col-sm-7 w3-container w3-border w3-round-xlarge msj-rta">
																<p><?php echo $message['chat_message'];?></p>
															</div>
														</div>
														
														<div class="col-md-12 col-sm-12 pull-right margin-20">
														<?php }else{ ?>
														<div class="col-md-1 col-sm-2 col-md-offset-4">
															<span style="color:green" >
															<b class="pull-right">You</b></span></div>
															
															<div class="col-md-7 col-sm-7 pull-right w3-border w3-round-xlarge msj">
																<p><?php echo $message['chat_message'];?></p>
															</div>
														<?php } ?>
														</div>
														
													</div>
												
													<?php } ?>
												</div>
												<?php } ?>
												<form name="" action="" method="post">
													<input name="id" value="<?php echo (!empty($r_data['id']))?$r_data['id']:'';    ?>" type="hidden">
													
													<input name="sendby" value="2" type="hidden">
													<div class="col-md-12 col-sm-12 custom_margin pd-15">
														<div class="col-md-12 col-sm-12 pd-15">
															<textarea name="chat_message" class="input_width" placeholder="Type here....."></textarea>
															<button type="submit" name="send" class="btn-success btn-lg-1 btn3d send-something" style="border-radius:0px;">Send Message</button>
														</div>
														<span class="text-left" style="color:#f85425; float:left;"><?php if(!empty($data['error']['chat_message'])){ echo $data['error']['chat_message'];} ?></span>
													</div>
													<div class="col-md-12 col-sm-12 custom_margin ">
														<div class="col-md-2 col-sm-2 text_align_right">
															
														</div>
														
													</div>
												</form>
												<?php } elseif(isset($id)) { ?>
													<div style="margin-left: 25%;margin-top:2%;" class="col-md-6 col-sm-6 input-group input-group-lg">
														
														<span style="color:red">
															*Request Id is not found in draftdaily database.
														</span>
													</div>
												<?php } ?>
												<div style="margin-top:5%;" class="col-md-6 col-sm-6 input-group input-group-lg">
														
												</div>
											</div>
										</section> 
									</aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php require_once("dd_footer.php");?>	
