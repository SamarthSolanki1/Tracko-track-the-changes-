<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['a_username']))
 {
 $username=$_SESSION['a_username'];
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

 </head>
<body>
  
<div id="navbar">
        <div class="logo">
            <a href="dashboard.php"><img src="tracko_logo.png"  width=100 height=100 ></a>
        </div>
        <ul >
            <li><a href="dashboard.php" >Dashboard</a></li>
            <li><a href="devices.php" >Devices</a></li>
            <li><a href="req_route.php">Request-Route</a></li>
                        <li><a href="out.php"><span class="fa fa-sign-out"></span>Sign-Out</a></li>

        </ul>
    </div>
    <br>
<div class= "container" align="center">
<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <style>
      canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
      }
    </style>
  </head>
  <body>
    <div style="width:70%;">
      <canvas id="myChart"></canvas>
    </div>
  </body>
</html>

<?php
include("connection.php");
$Q="SELECT loadtime,loadcap FROM truck_load where truck_no='$dev' and status='unload' order by ID DESC limit 5";
$r=mysqli_query($conn,$Q);
$f=mysqli_fetch_all($r);

$data = array(
    array("label"=> $f[4][0], "value"=> $f[4][1]),
    array("label"=> $f[3][0], "value"=> $f[3][1]),
    array("label"=> $f[2][0], "value"=> $f[2][1]),
    array("label"=> $f[1][0], "value"=> $f[1][1]),
    array("label"=> $f[0][0], "value"=> $f[0][1])
    
);

$labels = array();
$values = array();

foreach ($data as $row) {
    $labels[] = $row['label'];
    $values[] = $row['value'];
}

$labels = json_encode($labels);
$values = json_encode($values);

?>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo $labels; ?>,
        datasets: [{
            label: 'Usage & Productivity',
            data: <?php echo $values; ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max : 500
                }
            }]
        }
    }
});

</script>
</body></html></div>

    <div class="table-wrapper">
        <table border="3" class="fl-table" align="center" >
            <thead>
                 <tr>
                     <th>TRUCK-NO</th>
                     <TH>LOADING DATE AND TIME</TH>
                     <TH>UNLOADING DATE AND TIME</TH>
                     <TH>DRIVER</TH>
                     
                     <TH>ROUTE</TH>

                     <TH>LOAD-CARRIED</TH>
                     <TH>MINERAL</TH>
                     <th>ACTION</th>
                 </tr>
                 </thead>
                 <tbody>
                     <?PHP 
                     include("connection.php");
                     $Q="SELECT * FROM truck_load where truck_no='$dev' and status='unload' order by ID DESC limit 10";
                     $r=mysqli_query($conn,$Q);
                     while($d=mysqli_fetch_assoc($r))
                     {?><tr>
                         <td><?php echo $d['truck_no']; ?></td>
                         <td><?php echo $d['loadtime']; ?></td>
                         <td><?php echo $d['unloadtime']; ?></td>
                         <td><?php echo $d['driver']; ?></td>
                         <td><?php echo $d['routeid']; ?></td>
                         <td><?php echo $d['loadcap']; ?></td>
                         <td><?php echo $d['miner']; ?></td>
                         <td><form method="POST" action="recordview.php">
                                <input type="hidden" name="dev" value="<?php echo $dev;?>">
                                <input type="hidden" name="ltime" value="<?php echo $d['loadtime'];?>">
                                <input type="hidden" name="utime" value="<?php echo $d['unloadtime'];?>">
                                <button title="view" data-toggle="tooltip" type ="submit"> <span CLASS ="fa fa-eye"></span></button></form>&nbsp;</td>
                     </tr>
                 <?php } ?>
                 </tbody>
             </table>
         </div>
         </body>
</html>
<?php }
else {
    header("Location: index.php",TRUE,301);
}
?>


