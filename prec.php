
<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['p_username']))
 {
 $dev=$_SESSION['p_username'];

 ?>

 <!DOCTYPE html>
<html>

<head>
    <title>record</title>
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
.table-wrapper{
    margin: 10px 70px 10px;
    
}
section{
    margin: 10px 70px 0px;
}

.fl-table {
    border-radius: 5px;
    font-size: 18px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {

    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 18px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
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
    width: 40%;
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
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 </head>
<body>
  
<div id="navbar">
        <div class="logo">
            <a href="pdash.php"><img src="tracko_logo.png"  width=100 height=100 ></a>
        </div>
        <ul >
            <li><a href="pdash.php" >Dashboard</a></li>
            <li><a href="prec.php">record</a></li>
            <li><a href="out.php"><span class="fa fa-sign-out"></span>Sign-Out</a></li>
        </ul>
    </div>
    <br>
<div class= "container"></div>

    <div class="table-wrapper">
        <table border="3" class="fl-table" align="center">
            <thead><tr>
                <th>Date:</th>
                <th>Action:</th>
            </tr></thead>
            <tbody><form method="POST" action="">
                <tr><td><input type="date" name="d" value="<?php if(isset($_POST['submit'])){echo $_POST['d'];}?>"></td>
                    <td><input type="submit" name="submit"></td></tr>
                
            </form></tbody>
        </table>
    </div>



                
<html><section>
    <div id="map" style="width:100%; height: 100vh; "></div>
       <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

    <script>
        // import {antPath} from leaflet-ant-path;
        var map = L.map('map').setView([23,72.5],12);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
</script>

        <?php
        
        if(isset($_POST['submit'])){
            $r=$_POST['d'];
            $ltime=$r." 00:00:01";
            $utime=$r." 23:59:59";

             $sql = "SELECT lat,lng from live_personal where deviceid='$dev' and updatetime between '$ltime' and '$utime' ";
$res= mysqli_query($conn,$sql);
$mainres=mysqli_fetch_all($res);
$myArray = json_encode($mainres);

$s1="select * from live_personal where id=(select max(id) from live_personal where deviceid='$dev' and updatetime between '$ltime' and '$utime')";
$r1=mysqli_query($conn,$s1);
$d1=mysqli_fetch_assoc($r1);

$sql2="select * from live_personal where id=(select min(id) from live_personal where deviceid='$dev' and updatetime between '$ltime' and '$utime')";
$res2=mysqli_query($conn,$sql2);
$d2=mysqli_fetch_assoc($res2);
 ?>
 <script >
     var popup = L.popup()
            .setContent("<?php echo"Latitude=".$d1['lat']." & "."Longitude=".$d1['lng']."<br>".trim("last-updated-data",".")."<br>".$d1['updatetime'];?>");
           


        var marker = L.marker([<?php echo $d1['lat']  ?>,<?php echo $d1['lng']?>], ).addTo(map);
        marker.bindPopup(popup).openPopup();

         var popup = L.popup()
            .setContent("<?php echo"Latitude=".$d2['lat']." & "."Longitude=".$d2['lng']."<br>".trim("first-updated-data",".")."<br>".$d2['updatetime'];?>");
           


        var marker = L.marker([<?php echo $d2['lat']  ?>,<?php echo $d2['lng']?>], ).addTo(map);
        marker.bindPopup(popup).openPopup();
   

  var latlngs = [<?php echo str_replace('"','',$myArray);?>
  ];

var polyline = L.polyline(latlngs, {color: 'blue',"weight":7}).addTo(map);
</script>

 
    <?php }?>
</section>

    
        

    
</body>
</html>
<?php }
else {
    header("Location: plogin.php",TRUE,301);
}
?>


 

