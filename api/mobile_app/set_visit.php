<?php
include '../database.php';

date_default_timezone_set('Asia/Karachi');
$current_datetime = date('m/d/Y h:i:s a', time());
$current_time = time();

if(isset($_GET['user_id']) && isset($_GET['startup_id']))
{
    $user_id = $_GET['user_id'];
    $startup_id = $_GET['startup_id'];
    $stmt = $con->prepare('INSERT into startup_visits(user_id, startup_id, timestamp, visit_datetime) values(?,?,?,?)');
    $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
    $stmt->bindParam(2, $startup_id, PDO::PARAM_STR);
    $stmt->bindParam(3, $current_time, PDO::PARAM_STR);
    $stmt->bindParam(4, $current_datetime, PDO::PARAM_STR);
    if ($stmt->execute()===TRUE) 
    {
        $response = array();
        $response['error']=0;
        $response['message']="Visits updated";
        echo json_encode($response);
    }
    else 
    {
        $response = array();
        $response['error']=1;
        $response['message']="Unable to update visits";
        echo json_encode($response);
    }
}
else
{
    $temp = array();
	$temp['error'] = 1;
	$temp['message'] = "Invalid Parameters.";
	echo json_encode($temp);
}
?>