<?php 
	require_once('category-function.php');
	  
	  if(!empty($_GET['id'])){
		  $id=$_GET['id'];
		
		  try{
			  $sql="select * from `support_category` where `id`='$id'";
			  
			  $result=mysqli_query($conn,$sql);
			 
			  if($result){
				  $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
			  
			  }
		  }
		  catch(Exeption $e){
			  
		  }
	  }
	  
	if(!empty($_POST)){
		$datas = EditCategory($_POST,$conn);
		
	}
	 
?>
<?php require_once('header.php'); ?>
	<div class="wrapper row-offconvas row-offcanvas-left">
        <!-- Right side column. Contains the navbar and content of the page -->
		<?php require_once('sidebar.php'); ?> 
        <aside class="right-side">
            <!-- Main content -->
			<section class="content-header">
				<h1>
                    Edit Category 
                    <small>edit category </small>
                </h1>
			</section>
			<section class="content">
				 
                <div class="box box-primary">
                           
                                <!-- form start -->
							<form action="" method="post" enctype="multipart/form-data" >
							    <input name="id" value="<?php echo (!empty($data['id']))?$data['id']:'';    ?>" type="hidden">
								<div class="box-body">
								    
									<div class="form-group">
										<label for="exampleInputName">Category Name</label>
										<input type="text" class="form-control input_width" id="exampleInputName" name="category_name" value="<?php echo (!empty($data['category_name']))?$data['category_name']:''; ?>" placeholder="category name">
										<span style="color:red"><?php if(!empty($datas['error']['category_name'])) { echo $datas['error']['category_name']; } ?></span>
									</div>
									
									<div class="form-group">
										<label for="Input10">Status</label>
										<select class="form-control input_width" name="status" >
										<option <?php if(isset($data['status']) && ($data['status']==1)){ echo "selected"; } ?> value="1">Active</option> 
										<option value="2" <?php if(isset($data['status']) && ($data['status']==2)){ echo "selected"; } ?>>Inactive</option>
										</select> 
									</div>
									<!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" name="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
		<?php require_once("footer.php");?>
		<script>
		 $(document).ready(function(){
			 $('#treeview').addClass('active');
			 $('#sub-menu-1-1').addClass('active');
			 $('#treeview-menu1').addClass('active');
			 $('#treeview-menu1').attr("style","display: block;");
		 });
		</script>
       