<?php   
        require_once('category-function.php');
		
		if(!empty($_GET['id'])){
			$id=$_GET['id'];
			//echo $emp_id; die;
			try{
			   $my_data=DeleteCategory($id,$conn);
			}
			catch(Exeption $e){
				//echo "<pre>"; print_r($e); die;
			}
		}
?>