<?php
include '../database.php';
if(isset($_GET['user_id']) && isset($_GET['type']))
{
    $user_id = $_GET['user_id'];
    $type = $_GET['type'];
    
    $stmt = $con->prepare('Update users set type = ? where id = ?');
    $stmt->bindParam(1, $type, PDO::PARAM_STR);
    $stmt->bindParam(2, $user_id, PDO::PARAM_STR);
    if ($stmt->execute()===TRUE) 
    {
        $response = array();
        $response['error']=0;
        $response['message']="Type Updated";
        echo json_encode($response);
    }
    else {
        $response = array();
        $response['error']=1;
        $response['message']="Unable to update type";
        echo json_encode($response);
    }
}
else{
    $temp = array();
	$temp['error'] = 1;
	$temp['message'] = "Invalid Parameters.";
	echo json_encode($temp);
}
?>