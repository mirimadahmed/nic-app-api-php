<?php
include '../database.php';
if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['password']))
{
    $name = $_GET['name'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    $stmt = $con->prepare("SELECT id FROM users where email = ?");
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() > 0)
    {
    	$temp = array();
    	$temp['error']=1;
    	$temp['message'] = "You are already registered, please login.";
    	echo json_encode($temp);
    }
    else
    {
	    $stmt = $con->prepare('INSERT INTO users(name,email,password) VALUES(?,?,?)');
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $password, PDO::PARAM_STR);
        if ($stmt->execute()===TRUE) 
        {
            $response = array();

            $user_id =  $con->lastInsertId();            

            $stmt = $con->prepare("SELECT id,name,email,type,picture FROM users where id = ?");
            $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while($row = $stmt->fetchObject()) 
    		    {
                    $response = array("error"=>0,"user_details"=>$row);
                    echo json_encode($response);
                }
            }
    		
        }
        else
        {
        	$temp = array();
    		$temp['error'] = 1;
    		$temp['message'] = "Error while registering, please try again later.";
    		echo json_encode($temp);
        }
    }
}
else{
    $temp = array();
	$temp['error'] = 1;
	$temp['message'] = "Invalid Parameters.";
	echo json_encode($temp);
}
?>