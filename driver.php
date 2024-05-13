<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['d_username']))
 {
 $username=$_SESSION['d_username'];
 
 ?>

 <!DOCTYPE html>
<html>
<meta http-equiv="refresh" content="10">
<head>
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <style type="text/css">body
{
    margin: 0;
    padding: 0;
    font-family: arial, sans-serif;
}

section{
    margin: 10px 70px 0px;
}

.text{
    text-align: center;
    height: 100px;
    background: #262626;
    color: #FFF;
}
.text h2{
    margin: 0;
    line-height: 100px;
    font-size: 48px;
}
#navbar{
    overflow: hidden;
    background: #000;
    color: #FFF;
    display: flex;
    font-size: 18px;
    position: sticky;
    top: 0;

}
#navbar .logo{
    
    padding: 5px;
    margin-left: 40px
}
#navbar .logo a{
    color: #FFF;
    text-decoration: none
}
#navbar ul{
    margin: 20px;
    padding: 0;
    display: flex;
    width: 15%;
    margin-left: auto;

}
ul li{
    padding: 20px;
    list-style: none;
    
}
ul li a{
    color: grey;

    display: block;
    text-decoration: none;
    text-transform: uppercase;
    font-weight: bold
}
ul li a:hover{
    text-decoration: none;
    color: #fff;
}
section{
    height: 300px;
}
#map {
    position: relative;
    top: 0px; /* or however many pixels the navbar is tall */
    left: 0;
}
</style>

</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 
 </head>
<body>
  
<div id="navbar">
        <div class="logo">
            <a href="driver.php"><img src="tracko_logo.png"  width=100 height=100 ></a>
        </div>
        <ul >
           
            <li><a href="out.php"><span class="fa fa-sign-out"></span>Sign-Out</a></li>
        </ul>
    </div>
    <br>
            <?php
            $q2="select * from truck_load where id =(select max(id) from truck_load where driver='$username')"; 
                $r2=mysqli_query($conn,$q2);
                $d2=mysqli_fetch_assoc($r2);
                $truck=$d2['truck_no'];
                $q1="select * from live where srno =(select max(srno) from live where truckid='$truck')";
                $r1=mysqli_query($conn,$q1);
                $d1=mysqli_fetch_assoc($r1);
                
                ?>
                
    
<html><section>
    <div id="map" style="width:100%; height: 100vh; "></div>
       <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

    <script>
        // import {antPath} from leaflet-ant-path;
        var map = L.map('map').setView([<?php echo $d1['lat']?>,<?php echo $d1['lng']?>],16);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

       var popup = L.popup()
            .setContent("<?php echo"Latitude=".$d1['lat']." & "."Longitude=".$d1['lng']."<br>".trim($d1['msg'],".")."<br>".$d1['date_time'];?>");


        var marker = L.marker([<?php echo $d1['lat']  ?>,<?php echo $d1['lng']?>]).addTo(map);
        marker.bindPopup(popup).openPopup();
        <?php
        if ($d2['status']=='load'){
        $routename=$d2['routeid'];
         $sql = "SELECT lat,lng from routes where routeid='$routename'";
$res= mysqli_query($conn,$sql);
$mainres=mysqli_fetch_all($res);

$myArray = json_encode($mainres);

 ?>

  var latlngs = [<?php echo str_replace('"','',$myArray);?>
  ];

var polyline = L.polyline(latlngs, {color: 'blue',"weight":7}).addTo(map);
<?php }?>

    </script>
    
</section>

    
        

    
</body>
</html>
<?php }
else {
    header("Location: index.php",TRUE,301);
}
?>


 
