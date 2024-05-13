<?php      
  $db_host="p3nlmysql11plsk.secureserver.net:3306";
  $db_user="forestfiresystem";
  $db_password="Fsystem123*";
  $db_name="forestfiresystem";
  
  
  $conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
  if(!$conn){
      die("Connection Failed<br>");
  }
?>  