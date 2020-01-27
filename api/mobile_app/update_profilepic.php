<?php
include '../database.php';


if (isset($_FILES['picture']['name'])) {
    $result = uploadToS3("profile_pictures", $_FILES['picture']['name'], $_FILES['picture']['tmp_name']);
    $file = explode("/",$result["ObjectURL"]);
    $picture = $file[count($file)-1];
    
    $user_id = $_POST['user_id'];
    $stmt = $con->prepare('Update users set picture = ? where id = ?');
    $stmt->bindParam(1, $picture, PDO::PARAM_STR);
    $stmt->bindParam(2, $user_id, PDO::PARAM_STR);
    if ($stmt->execute()===TRUE) 
    {
        $response = array();
        $response['error'] = 0;
        $response['title']="Profile Picture";
        $response['message'] = "Profile picture has been updated successfully";
        $response['picture'] = $picture;
        echo json_encode($response);
    }
    else {
        $response = array();
        $response['error']=1;
        $response['message']="Unable to update profile picture";
        echo json_encode($response);
    }
    
    
}     

else{
    $temp = array();
    $temp['error']= 1;
    $temp['message']="Unable to upload file";
    echo json_encode($temp);
}
     
                    
                    
?>