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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

 </head>
<body>
  
<div id="navbar">
        <div class="logo">
            <a href="pdash.php"><img src="tracko_logo.png"  width=100 height=100 ></a>
        </div>
        <ul >
            <li><a href="pdash.php" >Dashboard</a></li>
            <li><a href="prec.php" >RECORDS</a></li>
        
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
                
                <th>LATITUDE</th>
                <TH>LONGITUDE</TH>
                <TH>SPEED </TH>
                <th>TEMP</th>
                <TH>HUMIDITY</TH>
                
                <TH>LAST-UPDATED TIME </TH>
            </tr>
            
            </thead>
            <tbody>
                <?php
                $q1="select * from live_personal where id=(select max(id) from live_personal where deviceid='$dev')";
                $r1=mysqli_query($conn,$q1);
                $d1=mysqli_fetch_assoc($r1);
               
                ?>
                <tr >
                    <td><b><?php echo $dev ;?></b></td>
                    
                    <td><b><?php echo $d1['lat'] ;?></b></td>
                    <td><b><?php echo $d1['lng'] ;?></b></td>
                    <td><b><?php echo $d1['speed'] ;?></b></td>
                    <td><b><?php echo $d1['temp'] ;?></b></td>
                    <td><b><?php echo $d1['humid'];?></b></td>
                   
                    <td><b><?php echo $d1['updatetime'] ;?></b></td>
                </tr>

            </tbody>
        </table>
    </div>
    <?php $speed=$d1['speed'];?>
<!DOCTYPE html>
<html>
<head>
    <title>Speedometer</title>
    <style>
        canvas {
            background-color: #eee;
            border-radius: 50%;
            margin-left: 80px;
        }
        
        .speed {
            font-size: 50px;
            font-weight: bold;
            margin-left: 80px;    
            text-align: left;
            text-shadow: 1px 1px 2px #444;
            color: #f00;
        }
        

    </style>
</head>
<body>
    <canvas id="speedometer" width="200" height="200"></canvas>
    <div class="speed"><?php echo $speed; ?> km/h</div>
    
    <script>
        // Get the canvas and context
        var canvas = document.getElementById("speedometer");
        var ctx = canvas.getContext("2d");
        
        // Draw the speedometer dial
        ctx.beginPath();
        ctx.arc(canvas.width/2, canvas.height/2, canvas.width/2 - 10, 0, 2 * Math.PI);
        ctx.lineWidth = 20;
        ctx.strokeStyle = "#555";
        ctx.stroke();
        
        // Draw the speedometer needle
        function drawNeedle(speed) {
            // Calculate the angle based on the speed
            var angle = speed / 220 * Math.PI - Math.PI/2;
            
            ctx.save();
            ctx.translate(canvas.width/2, canvas.height/2);
            ctx.rotate(angle);
            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx.lineTo(canvas.width/2 - 30, 0);
            ctx.lineWidth = 5;
            ctx.strokeStyle = "#f00";
            ctx.stroke();
            ctx.restore();
        }
        
        // Update the speedometer with the current speed
        function updateSpeedometer(speed) {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Draw the dial
            ctx.beginPath();
            ctx.arc(canvas.width/2, canvas.height/2, canvas.width/2 - 10, 0, 2 * Math.PI);
            ctx.lineWidth = 20;
            ctx.strokeStyle = "#555";
            ctx.stroke();
            
            // Draw the needle
            drawNeedle(speed);
            
            // Update the speed display
            document.querySelector('.speed').innerHTML = speed.toFixed(1) + " km/h";
        }
        
        // Call the updateSpeedometer function with the initial speed
        updateSpeedometer(<?php echo $speed; ?> );
    </script>
</body>
</html>

<html><section>
    <div id="map" style="width:100%; height: 100vh; "></div>
       <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

    <script>
        // import {antPath} from leaflet-ant-path;
        var map = L.map('map').setView([<?php echo $d1['lat']?>,<?php echo $d1['lng']?>],17);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
var myIcon = L.icon({
    iconUrl: 'red-box.png',
    iconSize: [38, 50],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
    
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});

       var popup = L.popup()
            .setContent("<?php echo"Latitude=".$d1['lat']." & "."Longitude=".$d1['lng']."<br>"."<br>".$d1['updatetime'];?>");
            

        var marker = L.marker([<?php echo $d1['lat']  ?>,<?php echo $d1['lng']?>]).addTo(map);
        marker.bindPopup(popup).openPopup();
        
    </script>
    
</section>

    
        

    
</body>
</html>
<?php }
else {
    header("Location: plogin.php",TRUE,301);
}
?>


 
