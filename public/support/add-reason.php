<?php
    require_once('category-function.php');
	
	if(!empty($_POST)) {
		$data = Addcategory($_POST,$conn);
	}
	
?>

<?php require_once('header.php'); ?>
<div class="wrapper row-offconvas row-offcanvas-left">
            <!-- Right side column. Contains the navbar and content of the page -->
	<?php require_once('sidebar.php'); ?> 
	<aside class="right-side">
		<section class="content-header">
			<h1>
				Add New Reason
				<small>add new reason</small>
			</h1>
		</section>
	
		<section class="content">
	
			<div class="box box-primary">
                                
            <!-- form start -->
				<form action="" method="post" enctype="multipart/form-data" >		   
		   
					<div class="box-body">
							<br>
						<div class="form-group">
							<label for="exampleInputName">Reason Name<span style="color:red"><b>*</b></span></label>
							<input type="text" name="category_name" class="form-control input_width" id="exampleInputEmail1" value="<?php echo (!empty($_POST['category_name']))? $_POST['category_name']:''; ?>" placeholder="Enter name">
							<span style="color:red;"><?php echo (!empty($data['error']['category_name']))?$data['error']['category_name']:'';?></span>
						</div>
						
						<div class="form-group">
							<label for="Input10">Status</label>
							<select class="form-control input_width" name="status" >
							<option <?php if(isset($_POST['status']) && ($_POST['status']==1)){ echo "selected"; } ?> value="1">Active</option> 
							<option value="2" <?php if(isset($_POST['status']) && ($_POST['status']==2)){ echo "selected"; } ?>>Inactive</option>
							</select> 
							<span style="color:red"><?php if(!empty($data['error']['status'])) { echo $data['error']['status']; } ?></span>
						</div>
				
						<div class="box-footer">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</section> 
	</aside>
</div>
<?php require_once("footer.php");?>	 
<script>
 $(document).ready(function(){
	 $('#treeview').addClass('active');
	 $('#sub-menu-1-2').addClass('active');
	 $('#treeview-menu1').addClass('active');
	 $('#treeview-menu1').attr("style","display: block;");
 });
</script>