<?php
include 'database.php';


if (isset($_FILES['logoFile']['name'])) {
    $result = uploadToS3("logos", $_FILES['logoFile']['name'], $_FILES['logoFile']['tmp_name']);
    $file = explode("/",$result["ObjectURL"]);
    $logo = $file[count($file)-1];
    
    $temp = array();
    $temp['error']= 0;
    $temp['logo']=$logo;
    echo json_encode($temp);
    
    
}     

else{
    $temp = array();
    $temp['error']= 1;
    $temp['message']="Unable to upload file";
    echo json_encode($temp);
}
     
                    
                    
?>