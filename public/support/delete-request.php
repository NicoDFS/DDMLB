<?php   
        require_once('function.php');
		
		if(!empty($_GET['id'])){
			$id=$_GET['id'];
			//echo $emp_id; die;
			try{
			   $my_data=DeleteRequest($id,$conn);
			}
			catch(Exeption $e){
				echo "<pre>"; print_r($e); die;
			}
		}
?>