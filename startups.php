<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // if(isset($_GET['user_id']))
    // {
    
        $startups = array();
        $stmt = $con->prepare('SELECT * from startups');
    // 	$stmt->bindParam(1, $_GET['emp_id'], PDO::PARAM_INT);
    // 	$stmt->bindParam(2, $password, PDO::PARAM_STR);
    	$stmt->execute();
    	if ($stmt->rowCount() > 0) 
    	{
    	    while($row = $stmt->fetchObject()) 
		    {
		        $startup = array();
		        $startup = $row;
		        $startup->industries = array();
		        $startup->tech = array();
		        $startup->founders = array();
                $stmt1 = $con->prepare('SELECT industries.name 
                                        from industries
                                        inner join startupsxindustries
                                        where startupsxindustries.startup_id = ?
                                        AND startupsxindustries.industry_id = industries.id');
            	$stmt1->bindParam(1, $startup->id, PDO::PARAM_INT);
            	$stmt1->execute();
            	if ($stmt1->rowCount() > 0) 
            	{
            	    while($row = $stmt1->fetchObject()) 
        		    {
		                array_push($startup->industries,$row);   
        		    }
            	}
            	
            	$stmt1 = $con->prepare('SELECT technologies.name 
                                        from technologies
                                        inner join startupsxtechnologies
                                        where startupsxtechnologies.startup_id = ?
                                        AND startupsxtechnologies.tech_id = technologies.id');
            	$stmt1->bindParam(1, $startup->id, PDO::PARAM_INT);
            	$stmt1->execute();
            	if ($stmt1->rowCount() > 0) 
            	{
            	    while($row = $stmt1->fetchObject()) 
        		    {
		                array_push($startup->tech,$row);   
        		    }
            	}
            	
            	
            	$stmt1 = $con->prepare('SELECT users.name,users.email,users.picture,founders.designation,founders.linkedin from users
                                        inner join founders
                                        where founders.startup_id = ?
                                        AND founders.user_id = users.id');
            	$stmt1->bindParam(1, $startup->id, PDO::PARAM_INT);
            	$stmt1->execute();
            	if ($stmt1->rowCount() > 0) 
            	{
            	    while($row = $stmt1->fetchObject()) 
        		    {
		                array_push($startup->founders,$row);   
        		    }
            	}
            	
		        
		        
                array_push($startups,$startup);
		    }
    	}
    	echo json_encode($startups);
}
else{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
    
    
?>