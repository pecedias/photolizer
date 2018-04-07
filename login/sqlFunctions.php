<?php
require 'credentials.php';
require_once('../config.php');

/******Adding Users To The Database And Updating Their Info If They Are Already Registered**************/

function checkAndAddUser($Fuid,$fname,$lname,$gender,$email,$fullname,$fblink,$dp,$referal){
	Global $conn;
	$idC = $conn->query("select * from users where email='$email'");
 $idC->execute();
 $result = $idC->fetch();
 $id = $result['email'];
	if (empty($id)) { // if new user . Insert a new record		
	$query = "INSERT INTO users (Fuid,fname,lname,email,fullname,fblink,gender,dp,lastlogin,referal) VALUES ('$Fuid','$fname','$lname','$email','$fullname','$fblink','$gender','$dp',now(),'$referal')";
	$conn->exec($query);
	$_SESSION['user_check']=$email;
	} else {   // If Returned user . update the user record	
	$_SESSION['user_check']=$email; 
	$query = "UPDATE users SET  lastlogin=now() WHERE email='$email' ";
	$conn->exec($query); 
	}
}?>