<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);

        $json = file_get_contents('php://input');
        $temp = json_decode($json);
        
        // echo json_encode($temp);
        
        
        $stmt = $con->prepare('insert into startups(name,tagline,about,cohort,status,logo, website, facebook, linkedin, twitter, instagram) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bindParam(1, $temp->name, PDO::PARAM_STR);
        $stmt->bindParam(2, $temp->tagline, PDO::PARAM_STR);
        $stmt->bindParam(3, $temp->about, PDO::PARAM_STR);
        $stmt->bindParam(4, $temp->cohort, PDO::PARAM_STR);
        $stmt->bindParam(5, $temp->status, PDO::PARAM_STR);
        $stmt->bindParam(6, $temp->logo, PDO::PARAM_STR);
        $stmt->bindParam(7, $temp->website, PDO::PARAM_STR);
        $stmt->bindParam(8, $temp->facebook, PDO::PARAM_STR);
        $stmt->bindParam(9, $temp->linkedin, PDO::PARAM_STR);
        $stmt->bindParam(10, $temp->twitter, PDO::PARAM_STR);
        $stmt->bindParam(11, $temp->instagram, PDO::PARAM_STR);
        $stmt->execute();
        
        $startup_id = $con->lastInsertId();
        
        $technologies = array();
        $technologies = $temp->technologies;
        
        for($i=0;$i<count($technologies);$i++)
        {
            $stmt = $con->prepare('INSERT INTO startupsxtechnologies(startup_id,tech_id) VALUES(?,?)');
            $stmt->bindParam(1, $startup_id, PDO::PARAM_STR);
            $stmt->bindParam(2, $technologies[$i]->id, PDO::PARAM_STR);
            $stmt->execute();
        }
        
        $industries = array();
        $industries = $temp->industries;
        for($i=0;$i<count($industries);$i++)
        {
            $stmt = $con->prepare('INSERT INTO startupsxindustries(startup_id,industry_id) VALUES(?,?)');
            $stmt->bindParam(1, $startup_id, PDO::PARAM_STR);
            $stmt->bindParam(2, $industries[$i]->id, PDO::PARAM_STR);
            $stmt->execute();
        }
        
        
        $founders = array();
        $founders = $temp->founders;
        for($i=0;$i<count($founders);$i++)
        {
            $type = "Founder";
            $stmt = $con->prepare('INSERT INTO users(name,email,type) VALUES(?,?,?)');
            $stmt->bindParam(1, $founders[$i]->name, PDO::PARAM_STR);
            $stmt->bindParam(2, $founders[$i]->email, PDO::PARAM_STR);
            $stmt->bindParam(3, $type, PDO::PARAM_STR);
            $stmt->execute();
            
            $user_id = $con->lastInsertId();
            
            $stmt = $con->prepare('INSERT INTO founders(user_id,startup_id,designation,linkedin) VALUES(?,?,?,?)');
            $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
            $stmt->bindParam(2, $startup_id, PDO::PARAM_STR);
            $stmt->bindParam(3, $founders[$i]->designation, PDO::PARAM_STR);
            $stmt->bindParam(4, $founders[$i]->linkedin, PDO::PARAM_STR);
            $stmt->execute();
            
            
        }
}
?>