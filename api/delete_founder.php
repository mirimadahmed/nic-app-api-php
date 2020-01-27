<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        
        $stmt = $con->prepare('delete from users where id = ?');
        $stmt->bindParam(1, $_GET['id'], PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $con->prepare('delete from founders where user_id = ?');
        $stmt->bindParam(1, $_GET['id'], PDO::PARAM_STR);
        $stmt->execute();

        $response = array();
        $response['error']=0;
        $response['message']="Deleted successfully";
        echo json_encode($response);
}
?>