<?php 


try {
require 'db.php';
$db=new Database;
$conn=$db->getConnection();
$qry="INSERT INTO emp (id,name,salary,doj) 
    VALUES (:id,:name,:salary,:doj)";
    // prepare sql and bind parameters
    $stmt = $conn->prepare($qry);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':salary', $salary);
    $stmt->bindParam(':doj', $doj);
    $id=htmlspecialchars($_POST["id"]);
     $name=htmlspecialchars($_POST["name"]);
      $doj=htmlspecialchars($_POST["doj"]);
       $salary=htmlspecialchars($_POST["salary"]);
       $result=$stmt->execute();
       if ($result) {
       	$response=array("status"=>1,"status_message"=>"data inserted");
       }
       else{
       	$response=array("status"=>0,"status_message"=>"error in inserting");
       }
       
} catch (PDOException $e) {
	
	if ($e->getCode()==23000) {
		$response=array("status"=>0,"status_message"=>"duplicate entry for id");
	}
	 	
}
header('Content-Type: application/json');
      echo  json_encode($response);	
 ?>