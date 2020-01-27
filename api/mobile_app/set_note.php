<?php
include '../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $user_id = $_GET['user_id'];
    $startup_id = $_GET['startup_id'];
    $note = $_GET['note'];

    $stmt = $con->prepare('SELECT * from user_notes where startup_id = ? AND user_id = ? ');
    $stmt->bindParam(1, $startup_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
	$stmt->execute();
	if ($stmt->rowCount() > 0) 
	{
	    $stmt = $con->prepare('update user_notes set note = ? where startup_id = ? AND user_id = ?');
        $stmt->bindParam(1, $note, PDO::PARAM_STR);
        $stmt->bindParam(2, $startup_id, PDO::PARAM_INT);
        $stmt->bindParam(3, $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $temp = array();
    	$temp['error'] = 0;
    	$temp['message']="Note Updated";
    	echo json_encode($temp);
	}
    else
    {
        $stmt = $con->prepare('insert into user_notes(startup_id,user_id,note) VALUES(?,?,?)');
        $stmt->bindParam(1, $startup_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(3, $note, PDO::PARAM_STR);
        $stmt->execute();

        $temp = array();
    	$temp['error'] = 0;
    	$temp['message']="Note Added";
    	echo json_encode($temp);
         
	}
}
else
{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
        
?>