<?php
require 'vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

$servername = "aajgq9ffxv30z4.cc1bqjqkpzke.us-east-1.rds.amazonaws.com";
$con_username = "root";
$con_password = "Knocking0ut";
$dbname = "nicapp";
$con = new PDO("mysql:host=$servername;dbname=$dbname", $con_username, $con_password);
$con->query( "SET NAMES 'UTF8'" );


function uploadToS3($folder, $file_name, $temp_file_location){

        $s3 = new Aws\S3\S3Client([
            'region'  => 'us-east-1',
            'version' => 'latest',
            'credentials' => [
                'key'    => "AKIAWCQQ7RP4SBVH43JX",
                'secret' => "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",
            ]
        ]);

		$result = $s3->putObject([
			'Bucket' => 'nic-app',
			'Key'    => $folder."/".$file_name,
			'SourceFile' => $temp_file_location,
			'ACL' =>'public-read'
        ]);
        
        return $result;
}
?>
