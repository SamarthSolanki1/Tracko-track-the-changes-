<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['c_username']))
 {
 $username=$_SESSION['c_username'];
 $dev = $_POST['dev'];
 ?>

 <!DOCTYPE html>
<html>

<head>
    <title>VIEW </title>
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
    font-size: 14px;
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
    font-size: 14px;
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
    width: 35%;
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

 </head>
<body>
  
<div id="navbar">
        <div class="logo">
            <a href="cdash.php"><img src="tracko_logo.png"  width=100 height=100 ></a>
        </div>
        <ul >
            <li><a href="cdash.php" >Dashboard</a></li>
            <li><a href="cdevices.php" >Devices</a></li>
            
                        <li><a href="out.php"><span class="fa fa-sign-out"></span>Sign-Out</a></li>

        </ul>
    </div>
    <br>
<div class= "container"></div>

    <div class="table-wrapper">
        <table border="3" class="fl-table" align="center" >
            <thead>
                 <tr>
                <TH>DEVICE-ID</TH>
                <TH>TRUCK-ID</TH>
                <th>LATITUDE</th>
                <TH>LONGITUDE</TH>
                <TH>ROUTE-ID</TH>
                <th>DRIVER</th>
                <TH>STATUS</TH>
                <TH>LOADING-TIME</TH>
                <TH>UNLOADING-TIME</TH>
                <TH>LAST-UPDATED TIME </TH>
            </tr>
            
            </thead>
            <tbody>
                <?php
                $q1="select * from live where srno =(select max(srno) from live where truckid='$dev')";
                $r1=mysqli_query($conn,$q1);
                $d1=mysqli_fetch_assoc($r1);
                $q2="select * from truck_load where id =(select max(id) from truck_load where truck_no='$dev')"; 
                $r2=mysqli_query($conn,$q2);
                $d2=mysqli_fetch_assoc($r2);
                ?>
                <tr <?php if($d1['msg']=="Off Route"){ ?>  style="color: red; font-weight: bold;"<?php } else {?> style="color: #228b22; font-weight: bold;"<?php }?>>
                    <td><?php echo $dev ;?></td>
                    <td><?php echo $dev ;?></td>
                    <td><?php echo $d1['lat'] ;?></td>
                    <td><?php echo $d1['lng'] ;?></td>
                    <td><?php echo $d2['routeid'] ;?></td>
                    <td><?php echo $d2['driver'] ;?></td>
                    <td><?php echo $d2['loadcap']."  ".$d2['miner']."  ".$d2['status'] ;?></td>
                    <td><?php echo $d2['loadtime'] ;?></td>
                    <td><?php echo $d2['unloadtime'] ;?></td>
                    <td><?php echo $d1['date_time'] ;?></td>
                </tr>

            </tbody>
        </table>
    </div>
<html><section>
    <div id="map" style="width:100%; height: 100vh; "></div>
       <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

    <script>
        // import {antPath} from leaflet-ant-path;
        var map = L.map('map').setView([<?php echo $d1['lat']?>,<?php echo $d1['lng']?>],17);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

       var popup = L.popup()
            .setContent("<?php echo"Latitude=".$d1['lat']." & "."Longitude=".$d1['lng']."<br>".trim($d1['msg'],".")."<br>".$d1['date_time'];?>");
           var myIcon = L.icon({
    iconUrl: 'red-box.png',
    iconSize: [38, 50],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
    
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});
        var marker = L.marker([<?php echo $d1['lat']  ?>,<?php echo $d1['lng']?>],{<?php  if($d1['msg']=="Off Route"){echo "icon: myIcon";} ?>}).addTo(map);
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

var polyline = L.polyline(latlngs, {color: 'blue',"weight":9}).addTo(map);


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


 
