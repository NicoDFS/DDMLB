<?php


    require_once('function.php'); 
	
	if(empty($_SESSION['draftdaily']['storage']->user_id)) {
		header('location:/signup');
	}
	
	if(!empty($_POST)) {
		$data = AddRequest($_POST,$conn);
	}
	try{
		$sql="SELECT * FROM `support_category` where `status`='1' ORDER BY `category_name`";
		$result=mysqli_query($conn,$sql);
		if($result){
			$datas1=mysqli_fetch_all($result,MYSQLI_ASSOC);
			
		}
	} catch(Exception $e){
		
	}
	
	
?>
<?php require_once('dd_header.php'); ?>
<div class="container mar-top">
    <div class="row">
		<div class="heading text-center">
			<h1>Add New Support Request</h1>
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
								<form action="" method="post" enctype="multipart/form-data" >		   
		   
									<div class="box-body">
										<div class="form-group text-white">
											<label class="font-medium-1 text-left" for="Input21">Select Reason<span style="color:red"><b>*</b></span></label>
											<select style="color: #000;" class="form-control" name="category_id" >
											<option value="">Select Reason</option>
											<?php if(!empty($datas1)) { foreach($datas1 as $dat){ ?>
											<option <?php echo ((!empty($_POST['category_id']))?(($_POST['category_id']==$dat['id'])?"Selected":''):''); ?> value="<?php echo trim($dat['id']);?>"><?php echo ucfirst($dat['category_name']);?></option>
											<?php }} ?>     
											</select>
											<span style="color:red"><?php if(!empty($data['error']['category_id'])){ echo $data['error']['category_id'];} ?></span>
										</div>
										
										<div class="form-group text-white">
											<label class="font-medium-1 text-left" for="exampleInputEmail1">Your Name<span style="color:red"><b>*</b></span></label>
											<input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo (!empty($_POST['name']))? $_POST['name']:''; ?>" placeholder="Enter Your Name">
											<span style="color:red"><?php if(!empty($data['error']['name'])) { echo $data['error']['name']; } ?></span>
										</div>

										<div class="form-group text-white">
											<label class="font-medium-1 text-left" for="exampleInputEmail1">Your Email<span style="color:red"><b>*</b></span></label>
											<input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo (!empty($_POST['email']))? $_POST['email']:''; ?>" placeholder="Enter Your Email">
											<span style="color:red"><?php if(!empty($data['error']['email'])) { echo $data['error']['email']; } ?></span>
										</div>
                        					
										<div class="form-group text-white">
											<label class="font-medium-1 text-left" for="exampleInputPassword1">Message</label>
											<textarea name="message" rows="5" class="form-control" id="exampleInputPassword1" value="<?php echo (!empty($_POST['message']))? $_POST['message']:''; ?>" placeholder="Message"></textarea>
										</div>
                        					
                        					
										<div class="form-group text-white">
											<label class="font-medium-1 text-left" for="exampleInputFile">File input</label>
											<input type="file" name="file" id="exampleInputFile">
										</div>
                        					  
										<div class="box-footer text-left">
											<button type="submit" name="submit" class="btn-success btn-lg btn3d">  Submit  </button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>          
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("dd_footer.php");?>	