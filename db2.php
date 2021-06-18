<?php
try{
	$con=new PDO("mysql:host=localhost;dbname=project","root","");
}catch(PDOExection $e){
	echo $e->getMessage();
}
?>