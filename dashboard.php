<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['a_username']))
 {
 $username=$_SESSION['a_username'];
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
    width: 50%;
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

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>

</head>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

 </head>
<body>
  
<div id="navbar">
        <div class="logo">
            <a href="dashboard.php"><img src="tracko_logo.png"  width=100 height=100 ></a>
        </div>
        <ul >
            <li><a href="dashboard.php" >Dashboard</a></li>
            <li><a href="devices.php">Devices</a></li>
            <li><a href="req_route.php">Request-Route</a></li>
            <li><a href="out.php"><span class="fa fa-sign-out"></span>Sign-Out</a></li>
        </ul>
    </div>

    <br>
<div class= "container"></div>

    <div class="table-wrapper">
        <table border="3" class="fl-table" align="center">
            <thead>
            <tr>
                <th>DEVICE-ID</th>
                <th>TRUCK-NO</th>
                <TH>ROUTE</TH>
                <TH>STATUS</TH>
                
                <th>LAST-UPDATE-TIME</th>
                <TH>ON-ROUTE</TH>
            </tr>
            </thead>
            <tbody>
            <?PHP 
            include('connection.php');

            $q="SELECT deviceid FROM admin_devices WHERE username= '$username' ";
            $r=mysqli_query($conn,$q);
            while($row = mysqli_fetch_assoc($r))
            {
                $dev=$row['deviceid'];
                $q1="select * from live  where srno =(select max(srno) from live where truckid='$dev')";
                $r1=mysqli_query($conn,$q1);
                while ($row1=mysqli_fetch_assoc($r1))
                {
                  $Q2="SELECT * from truck_load where id=(select max(id) from truck_load where truck_no='$dev')";
                  $r2=mysqli_query($conn,$Q2);
                     while ($row2=mysqli_fetch_assoc($r2))
                     {
                      ?><tr <?php if($row1['msg']=="Off Route"){ ?>  style="color: red;"<?php } else {?> style="color: #228b22;"<?php }?>>
                        <td><B><?php echo $dev;?></B></td>
                        <td><B><?php echo $dev;?></B></td>
                        <td><B><?php echo $row2['routeid']; ?></B></td>
                        <td><B><?php echo $row2['loadcap']." ".$row2['miner']." ".$row2['status']; ?></B></td>
                        <TD><b><?php echo $row1['date_time']; ?></b></TD>
                        <td><html>
    
    <?php
    $colorbutton="green";
    if($row1['msg']=="Off Route"){
        $colorbutton="red";
    }
    ?>
    <body>
        <input type="button" style="background-color:<?php echo $colorbutton?>; width: 60px; height: 25px;">
    </body>
    </html>
    </td>
                       </tr><?php
                }
            }
            }


            ?>
            </tbody>
        </table>
    </div>
<html><section>
    <div id="map" style="width:100%; height: 100vh; "></div>
       <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

    <script>
        var map = L.map('map').setView([23.15,72.63],11);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
var myIcon = L.icon({
    iconUrl: 'red-box.png',
    iconSize: [38, 50],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
    
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});

        <?php 
        $q="SELECT deviceid FROM admin_devices WHERE username= '$username' ";
            $r=mysqli_query($conn,$q);
            while($row = mysqli_fetch_assoc($r))
            {
                $dev=$row['deviceid'];
                $sql="SELECT * FROM live where srno =(select max(srno) from live where truckid='$dev')";
                $res=mysqli_query($conn,$sql);
                $f=mysqli_fetch_assoc($res);
                ?>
                var marker = L.marker([<?php echo $f['lat'] ?>,<?php echo $f['lng']?>],{<?php  if($f['msg']=="Off Route"){echo "icon: myIcon";} ?>}).addTo(map);
                var popup = L.popup()
            .setContent("<?php echo"Device=".$dev."<br>"."Latitude=".$f['lat']." & "."Longitude=".$f['lng']."<br>".trim($f['msg'],".");?>");
             marker.bindPopup(popup).openPopup();
        

                <?php
            }?>
            
    </script>
    
</section>

    
        

    
</body>
</html>
<?php }
else {
    header("Location: index.php",TRUE,301);
}
?>


 
