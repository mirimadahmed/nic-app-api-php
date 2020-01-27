<?php
include '../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $user_id = $_GET['user_id'];
    $gcm_key = $_GET['gcm_key'];

    $stmt = $con->prepare('update users set gcm_key = ? where id = ?');
    $stmt->bindParam(1, $gcm_key, PDO::PARAM_STR);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $temp = array();
    $temp['error'] = 0;
    $temp['message']="GCM key added";
    echo json_encode($temp);

}
else
{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
        
?>