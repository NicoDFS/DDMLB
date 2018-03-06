<?php 
	include('category-function.php');
	
	try{
		$datas=getAllCategory($conn);
	} catch(Exception $e){
		//echo "<pre"; print_r($e); die;
	}
	
?>
<?php require_once('header.php'); ?>
<div class="wrapper row-offconvas row-offcanvas-left">
	<!-- Right side column. Contains the navbar and content of the page -->
	<?php require_once('sidebar.php'); ?> 
	<aside class="right-side">
	    <section class="content-header">
			<h1>
				Category Details
				<small>category details</small>
			</h1>
			<?php if(!empty($_SESSION['message']))  { ?>
			<span style="color:green; margin-left:40%;"><b><?php echo $_SESSION['message'];?></b></span>
			<?php  } $_SESSION['message']='';?>
			
			<?php if(!empty($_SESSION['error_msg']))  { ?>
			<span style="color:red; margin-left:40%;"><b><?php echo $_SESSION['error_msg']; ?></b></span><?php } $_SESSION['error_msg']='';?>
			
	    </section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
					 
						</div>
						<!-- /.box-header -->
						<div class="box-body" >
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Category Name</th>

										<th>Status</th>
										
									    <th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($datas)): foreach($datas as $data) { //print_r($data); die;?>
									<tr>
										<td><?php echo  ucfirst($data['category_name']);?></td>
										
										<td style="<?php echo ($data['status']==1)? "color:green;":"color:red;";?>" ><?php echo ($data['status']==1)? "Active":"Inactive";?></a>
										</td>
										
										<td>
										<a href="edit-category?id=<?php echo $data['id'];?>">Edit</a> ||
										<a onclick="return confirm ('Are you sure you want to delete?');" href="delete-category?id=<?php echo $data['id'];?>"> Delete </a> 				 
										</td>
										
									  
									</tr>
									<?php } endif; ?>
									
								</tbody>
						
							</table>
						</div>
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
	 $('#treeview').addClass('active');
	 $('#sub-menu-1-1').addClass('active');
	 $('#treeview-menu1').addClass('active');
	 $('#treeview-menu1').attr("style","display: block;");
 });
</script>





