<?php

$db_host="p3nlmysql11plsk.secureserver.net:3306";
$db_user="forestfiresystem";
$db_password="Fsystem123*";
$db_name="forestfiresystem";
$conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
$dev=$_GET['dev'];
$lat=$_GET['lat'];
$lng=$_GET['lng'];
$speed=$_GET['speed'];
$temp=$_GET['temp'];
$humid=$_GET['humid'];

if($lat=='0.0000'&& $lng=='0.0000'){
    exit("Invalid Data");
}
else{
$sql="select CONVERT_TZ(CURRENT_TIMESTAMP,'+00:00','+12:30');";
$result =mysqli_query($conn,$sql);
$daterows= mysqli_fetch_array($result);
$dt =$daterows[0];


$sql = "insert into forestfiresystem.live_personal (lat,lng,speed,temp,humid,updatetime,deviceid) values('$lat','$lng','$speed','$temp','$humid','$dt','$dev');";
$result =mysqli_query($conn,$sql);
echo $result;
}
?>