<?php
	require_once '../../vendor/autoload.php';
	require_once('dbconn.php');
	require_once('constent.php');
	
	function getAllRequest($conn=null) {
		$sql="select `support_requests`.*,`support_category`.`category_name` from `support_requests` INNER join `support_category` ON support_requests.category_id=support_category.id ORDER BY `support_requests`.`status` ASC,`support_requests`.`id` DESC";
		
		$result=mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result)>0){
			$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
			
			return $data;
		}
	}

	function randomString($length = 8) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
	
	function AddRequest($data=null,$conn=null){
		
		$res=array();
		
		if(empty($data['name'])){
			$res['error']['name']="*Please enter your name.";
		}
		
		if(empty($data['email'])){
			$res['error']['email']="*Please enter your email.";
		}
		
		if(empty($data['category_id'])){
			$res['error']['category_id']="*Please select your reason.";
		}
		
		if(empty($res)){
			$category_id=$data['category_id'];	
			$name=$data['name'];
			$email=$data['email'];
			$message=$data['message'];
			$status="pending";
			$request_id = randomString();
			
			if(!empty($_FILES['file']['name'])){
				$file_name=time()."_".$_FILES['file']['name'];
				$file_tmp=$_FILES['file']['tmp_name'];
				move_uploaded_file($file_tmp,"files/".$file_name);
				
			}else{
				$file_name = "";
			}
			//echo "<pre>"; print_r($_FILES); die;	
			$sql="INSERT INTO `support_requests`(  `name`, `email`, `message`, `file`, `status`,`category_id`,`request_id`) VALUES ('$name','$email','$message','$file_name','$status','$category_id','$request_id')";
			
			$result=mysqli_query($conn,$sql);
			
			if($result){
				if(!empty($request_id)){
					
					
					$_SESSION['message_dashboard'] ="Dear $name,<br>Your request has been successfully sent to draftdaily support team.<br>You can track your request status by using <br> RequestId <span style='color:brown;'>'$request_id'</span>";
					
					$email_message = "Your request has been successfully sent to draftdaily support team.
						You can track your request status by using
						RequestId '$request_id'";
					
					try{
						$client = new Postmark\PostmarkClient("6c169aac-d64d-4a92-9b26-cb36159e1ca4");
						
						$array_data = [
							"username" => $name,
							"subject" => "Draftdaily support",
							"track_link" => "https://draftdaily.com/public/support/track-request?request_id=".$request_id,
							"message" => $email_message,
						] ;
						
						$result = $client->sendEmailWithTemplate("support@draftdaily.com",$email,"4162525",$array_data);
						
						$result = $client->sendEmailWithTemplate("support@draftdaily.com","admin@draftdaily.com","4162525",$array_data);
					} catch (Exception $e){
					  
					}
				}
				
				
				header('location:dashboard');
			}	

		}
		return $res;
	}
	
	function editRequest($data=null,$conn=null){
		$status=$data['status'];
		$id=$_GET['id'];
		
	    $sql="UPDATE `support_requests` SET `status`='$status' WHERE `id`='$id'";  
		$result=mysqli_query($conn,$sql);
		if($result){ 
			$_SESSION['message']="Request information has been updated successfully.";
			
			$sql2="Select * From `support_requests` WHERE `id`='$id'";
			$result2=mysqli_query($conn,$sql2);
			
			if($result2){ 
				$data_res = mysqli_fetch_assoc($result2);
				$request_id = $data_res['request_id'];
				$email_message = "Your request has been added in ".$data_res['status']." by support team . 
					contact us by email at support@draftdaily or track your
					RequestId '$request_id'";
				
				try{
					$client = new Postmark\PostmarkClient("6c169aac-d64d-4a92-9b26-cb36159e1ca4");
					
					$array_data = [
						"username" => $data_res['name'],
						"subject" => "Draftdaily support",
						"track_link" => "https://draftdaily.com/public/support/track-request?request_id=".$request_id,
						"message" => $email_message,
					] ;
					
					$result = $client->sendEmailWithTemplate("support@draftdaily.com",$data_res['email'],"3804301",$array_data);
				} catch (Exception $e){
				  
				}
			
			}
			
			
			$url =  $_SERVER['HTTP_REFERER'];
			header('location:'.$url);
		}
		else{
			$_SESSION['error']['message']="Something are wrong.";
			$url =  $_SERVER['HTTP_REFERER'];
			header('location:'.$url);
		}
	}
	
	function DeleteRequest($id=null,$conn=null){
			
		$sql="DELETE FROM `support_requests` WHERE `id`='$id'"; 
		$result=mysqli_query($conn,$sql);
		if($result){
			$_SESSION['message']="Record has been deleted successfully.";
			header('location:request-details');
		}
	}
	
	
	
	function addChat($data=null,$conn=null){
		$res=array();
		
		if(empty($data['chat_message'])){
			$res['error']['chat_message']="*Please enter message.";
		}
		
		if(empty($res)){
			
			$r_id=$data['id'];
			$sendby=$data['sendby'];
			$chat_message=$data['chat_message'];
			
			$sql="INSERT INTO `support_chats`( `chat_message`,`request_id`,`send_by`,`status`) VALUES ('$chat_message','$r_id','$sendby','1')";
			$result=mysqli_query($conn,$sql);
			
			if($result){
				$url =  $_SERVER['HTTP_REFERER'];
				header('location:'.$url);
			}
		}
		return $res;	
	}	
?>