<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['a_username']))
 {
 $username=$_SESSION['a_username'];

 ?>

 <!DOCTYPE html>
<html>

<head>
    <title>REQUEST ROUTE</title>
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
                <th>FROM-LATITUDE</th>
                <th>FROM-LONGITUDE</th>
                <TH>TO-LATITUDE</TH>
                <TH>TO-LONGITUDE</TH>
            </tr>
            </thead>
            <tbody>
                <form method="POST" action="">
                    <TR>
                        <TD><input type="NUMBER" name="F-LAT" step=any required <?PHP
        IF(isset($_POST['SUBMIT'])) 
        { echo "value=\"".$_POST['F-LAT']."\""; }?>></TD>
                        <TD><input type="NUMBER" name="F-LNG" step=any required <?PHP
        IF(isset($_POST['SUBMIT'])) 
        { echo "value=\"".$_POST['F-LNG']."\""; }?>></TD>
                        <TD><input type="NUMBER" name="T-LAT"step=any required <?PHP
        IF(isset($_POST['SUBMIT'])) 
        { echo "value=\"".$_POST['T-LAT']."\""; }?>></TD>
                        <TD><input type="NUMBER" name="T-LNG"step=any required <?PHP
        IF(isset($_POST['SUBMIT'])) 
        { echo "value=\"".$_POST['T-LNG']."\""; }?>></TD>
                    </TR>
                    <TR >
                        <td colspan="4"><button type="SUBMIT" NAME="SUBMIT" style="background: #1c87c9; border-radius: 5px; 
      border: none; font-size: 18; width: 10%;
      font-weight: bold; color: white;">SUBMIT</button></td>

                    </TR>
                </form>
            </tbody>
        </table>
    </div>
<html><section>
    <div id="map" style="width:100%; height: 100vh; "></div>
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

    <script>
        // import {antPath} from leaflet-ant-path;
        
        <?PHP
        IF(isset($_POST['SUBMIT'])) 
        { 
        ?>
            var map = L.map('map').setView([<?PHP ECHO $_POST['F-LAT']; ?>,<?PHP ECHO $_POST['F-LNG']; ?>],12);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

             var marker = L.marker([<?PHP ECHO $_POST['F-LAT']; ?>,<?PHP ECHO $_POST['F-LNG']; ?>]).addTo(map);
             var marker1 = L.marker([<?PHP ECHO $_POST['T-LAT']; ?>,<?PHP ECHO $_POST['T-LNG']; ?>]).addTo(map);
             L.Routing.control({
            waypoints: [
                L.latLng(<?PHP ECHO $_POST['F-LAT']; ?>,<?PHP ECHO $_POST['F-LNG']; ?>),
                L.latLng(<?PHP ECHO $_POST['T-LAT']; ?>,<?PHP ECHO $_POST['T-LNG']; ?>)
            ]
        }).addTo(map);

        <?PHP $flt=$_POST['F-LAT'];
        $FLG=$_POST['F-LNG'];
        $TLT=$_POST['T-LAT'];
        $TLG=$_POST['T-LNG'];
include("CONNECTION.PHP");
        $SQL="INSERT INTO request_route values('$flt','$FLG','$TLT','$TLG','$username')";
        $RUN=MYSQLI_QUERY($conn,$SQL);
} ELSE{
            ?>
            var map = L.map('map').setView([23,73],10);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);


            <?PHP
        } ?>

        

            
    </script>
    
</section>

    
        

    
</body>
</html>
<?php }
else {
    header("Location: index.php",TRUE,301);
}
?>


 
