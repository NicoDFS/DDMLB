<?php
include('function.php');
	try{
		$datas=getAllRequest($conn);
	} catch(Exception $e){
		
	}
	if(!empty($_POST)){
		//echo "<pre>"; print_r($_POST); die;
		$i = 0;
		foreach($_POST['request_id'] as $r_id){
			$sql="DELETE FROM `support_requests` WHERE `id`='$r_id'"; 
			$result=mysqli_query($conn,$sql);
			if($result){
				$i++;				
			}
		}
		if($i>0){
			$_SESSION['message']="$i Record has been deleted successfully.";
			header("location:/support/request-details");
		}else{
			$_SESSION['message']="No Record has been deleted.";
		}	
	}
?>
<?php require_once('header.php'); ?>
<div class="wrapper row-offconvas row-offcanvas-left">
	<!-- Right side column. Contains the navbar and content of the page -->
	<?php require_once('sidebar.php'); ?> 
   <aside class="right-side">
	    <section class="content-header">
			<h1>
				Request Details
				<small>request details</small>
			</h1>
			<span style="color:green; margin-left:40%;"><b><?php if(!empty($_SESSION['message']))  { echo $_SESSION['message']; } $_SESSION['message']='';?></b></span>
			<span style="color:red; margin-left:40%;"><b><?php if(!empty($_SESSION['error_msg']))  { echo $_SESSION['error_msg']; } $_SESSION['error_msg']='';?></b></span>
			
	    </section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						 
						</div>
						<form action="" method="post" id="form_1">
						<!-- /.box-header -->
						<div >
							<button type="submit" onclick="return confirm ('Are you sure you want to delete?');" id="delete_button" style="margin: 0px 11px 9px 0px;width: 11%;" class="btn btn-danger pull-right">Delete</button>
						</div>
						
						<div class="box-body" >
							<table id="example2" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th><input type="checkbox" id="checkAll" /></th>
											<th>RequestId</th>
											<th>Username</th>
											<th>Email</th>
											<th>Category Name</th>
											
											<th>Status</th>
																												

											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										
										<?php if(!empty($datas)): foreach($datas as $data) { //print_r($data); die;?>
										<tr>
										
											<td><input type="checkbox" value="<?php echo $data['id'];?>" name="request_id[]"/></td>
											
											<td><?php echo  ($data['request_id']);?></td>
											
											<td><?php echo  ucfirst($data['name']);?></td>
											
											<td><?php echo  ($data['email']);?>
											</td>
											
											<td><?php echo  ($data['category_name']);?></td>
											
											<td style="color:<?php echo ($data['status']=='pending')?'red':(($data['status']=='progress')?'maroon':'green'); ?>"><?php echo ucfirst($data['status']); ?>
											</td>
											 
											<td>
											
											<a onclick="return confirm ('Are you sure you want to delete?');" href="delete-request?id=<?php echo $data['id'];?>"> Delete </a> || <a href="manage-request?id=<?php echo $data['id'];?>">Manage</a>				 
											</td>
										  
										</tr>
										<?php } endif; ?>
										
									</tbody>
									
							
							</table>
						</div>
						</form>
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
	
	$("#checkAll").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
	
	$("#form_1").submit(function(){
		if ($("input:checkbox:checked").length > 0)
		{
			$("#form_1").submit();
		}else{
			alert('Please select atleast one record.');
		}
	});
	
	
	 $('#treeview2').addClass('active');
	 $('#sub-menu-2-1').addClass('active');
	 $('#treeview-menu2').addClass('active');
	 $('#treeview-menu2').attr("style","display: block;");
 });
</script>




