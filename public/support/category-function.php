<?php
	require_once('dbconn.php');
	require_once('constent.php');
//echo HOSTNAME;die;
	function getAllCategory($conn=null) {
		$sql="SELECT * FROM `support_category`";
		$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)>0){
			$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
			return $data;
		}
	}




	function Addcategory($data=null,$conn=null){
		//echo HOSTNAME;die;
		$res=array();
		
		if(empty($data['category_name'])){
		$res['error']['category_name']="*Please insert categoryname.";
		}
		if(empty($data['status'])){
		$res['error']['status']="*Please insert your status.";

		}		
		if(empty($res)){
			$category_name=$data['category_name'];
			$status=$data['status'];
			$query="SELECT * FROM support_category WHERE category_name='$category_name'";
				$run=mysqli_query($conn,$query);
				if(mysqli_num_rows($run)>0){
					
					$res['error']['category_name']="*Reason already exist.";
					
				} else {
					
					$sql="INSERT INTO `support_category`(`category_name`, `status`)VALUES ('$category_name','$status')";
			
					$result=mysqli_query($conn,$sql); 
			
					if($result){
				
						$_SESSION['message']="Registration successfully.";
				
						header('location:reason-details');
					}
				}	
		}
		return $res;
	}	
	function EditCategory($data=null,$conn=null){
        $res1=array();
		
		if(empty($data['category_name'])){
			$res1['error']['category_name']="*Please insert reason name";
		}
		if(empty($data['status'])){
			$res1['error']['status']="*Please insert status";
		}
	    if(empty($res1)){
			$id=$data["id"];
			$category_name=$data["category_name"];
			$status=$data["status"];
			$query1="UPDATE `support_category` SET `category_name`='$category_name',`status`='$status' WHERE `id`='$id'";
			
			$result=mysqli_query($conn,$query1);
				
			    if($result){
					$_SESSION['message'] = "Reason has been updated successfully";
					header('location:reason-details');
				}
	
		}
		return $res1;
	
	}
	
	function DeleteCategory($id=null,$conn=null){
			
		$sql="DELETE FROM `support_category` WHERE `id`='$id'"; 
		$result=mysqli_query($conn,$sql);
		if($result){
			 $_SESSION['message']="Reason has been deleted successfully.";
			 header('location:reason-details');
		}
	    }
	
	?>