<?php 
 include('connection.php');
 session_start();
 if (isset($_SESSION['c_username']))
 {
 $username=$_SESSION['c_username'];
 ?>
<html>
<meta http-equiv="refresh" content="10">
<head>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style type="text/css">
        body
{
    margin: 0;
    padding: 0;
    font-family: arial, sans-serif;
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
.table-wrapper{
    margin: 10px 70px 10px;
    
}
section{
    margin: 10px 70px 0px;
}

.fl-table {
    border-radius: 5px;
    font-size: 15px;
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
    font-size: 15px;
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
.flex-parent {
  display: flex;
}

.jc-center {
  justify-content: center;
}

button.margin-right {
  margin-right: 20px;
}
</style>
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
    <div class="table-wrapper">
    <table border="3" class="fl-table" align="center" >
        <thead>
        <tr >
            <th>DEVICE-ID</th>
            <th>TRUCK-NO</th>
            <th>STATUS</th>
            <th>ROUTE-ID</th>
            <th>DRIVER</th>
            <th>LOADING TIME </th>
            <th>UNLOADING TIME</th>
            <th>CARRING LOAD</th>
            <th>MINERAL</th>
            <th>ACTION</th>
        </tr>
        </thead>
        <tbody>
        <?PHP 
         include('connection.php');

            $q="SELECT deviceid FROM client_device WHERE cusername= '$username' ";
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
                     {?>
                        <tr <?php if($row1['msg']=="Off Route"){ ?>  style="color: red; font-weight: bold;"<?php } else {?> style="color: #228b22; font-weight: bold;"<?php }?>>
                            <TD><?PHP ECHO $dev?></TD>
                            <TD><?PHP ECHO $dev?></TD>
                            <TD><?PHP ECHO $row2['status']?></TD>
                            <TD><?PHP ECHO $row2['routeid']?></TD>
                            <TD><?PHP ECHO $row2['driver']?></TD>
                            <TD><?PHP ECHO $row2['loadtime']?></TD>
                            <TD><?PHP ECHO $row2['unloadtime']?></TD>
                            <TD><?PHP ECHO $row2['loadcap']?></TD>
                            <TD><?PHP ECHO $row2['miner']?></TD>
                            <td > <div class="flex-parent jc-center"><form method="POST" action="cview.php">
                                <input type="hidden" name="dev" value="<?php echo $dev;?>"><button title="CURRENT VIEW" data-toggle="tooltip" type ="submit"> <span CLASS ="fa fa-eye"></span></button></form>&nbsp;

</div>
                           
                             </td>
                        </TR>

<?PHP } }} ?>
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