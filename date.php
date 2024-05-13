<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['p_username']))
 {
 $dev=$_SESSION['p_username'];

 ?>
<html>
<body>
	<form method="POST" action="">
		<input type="date" name="d" value="<?php if(isset($_POST['submit'])){echo $_POST['d'];}?>">
		<br>
		<input type="submit" name="submit">
	</form>
	<?php if(isset($_POST['submit'])){
		$r = $_POST['d'];
		echo "your select =".$r."<br>";
		$ltime=(string)$r;
		$ltime=$ltime." 00:00:01";
		echo $ltime;
		
	}?>
</body>
</html>


 <?php
 include("connection.php");
        
        if(isset($_POST['submit'])){
        $r = $_POST['d'];
        echo "your select =".$r."<br>";
         $utime=(string)$r;
        $ltime=(string)$r;
        $ltime=$ltime." 00:00:01";
        echo $ltime;
       
        $utime=$utime." 23:59:59";
        echo $utime;
         $sql = "SELECT lat,lng from live_personal where deviceid='$dev' and updatetime between '$ltime' and '$utime' ";
$res= mysqli_query($conn,$sql);
$mainres=mysqli_fetch_all($res);
print_r($mainres);
$myArray = json_encode($mainres);
}}
 ?>

