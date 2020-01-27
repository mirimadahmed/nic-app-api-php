<?php
include '../database.php';
if(isset($_GET['user_id']) && isset($_GET['old_pass']) && isset($_GET['new_pass']))
{
    $user_id = $_GET['user_id'];
    $old_pass = $_GET['old_pass'];
    $new_pass = $_GET['new_pass'];
    $stmt = $con->prepare("SELECT id from users where id = ? AND password = ?");
    $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
    $stmt->bindParam(2, $old_pass, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() > 0)
    {
    	while ($row = $stmt->fetchObject()) 
    	{
            $stmt = $con->prepare("UPDATE users set password = ? where id = ?");
            $stmt->bindParam(1, $new_pass, PDO::PARAM_STR);
            $stmt->bindParam(2, $user_id, PDO::PARAM_STR);
            if($stmt->execute()===true)
            {
                $temp = array();
                $temp['error']=0;
                $temp['title']="Password Updated";
            	$temp['message'] = "Your password has been updated successfully";
                echo html_entity_decode(json_encode($temp));
            }
    	}
    }
    else
    {
    	$temp = array();
    	$temp['error']=1;
    	$temp['message'] = "Wrong old password";
    	echo json_encode($temp);
    }
}
else{
    $temp = array();
	$temp['error']=1;
	$temp['message'] = "Invalid Parameters";
	echo json_encode($temp);
}




?>