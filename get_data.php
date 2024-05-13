<?php
// Make a connection to the database
$db_host="p3nlmysql11plsk.secureserver.net:3306";
$db_user="forestfiresystem";
$db_password="Fsystem123*";
$db_name="forestfiresystem";


$conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);

// Perform a query to retrieve data from the database
$query = "SELECT * FROM live_personal ORDER BY id DESC limit 10";
$result = mysqli_query($conn, $query);

// Generate HTML for the table rows
$rows = '';

while ($row = mysqli_fetch_assoc($result)) {
	 $rows .= '<tr>';
	$rows .= '<td>' . $row['id'] . '</td>';
	$rows .= '<td>' . $row['lat'] . '</td>';
	$rows .= '<td>' . $row['lng'] . '</td>';
    $rows .= '<td>' . $row['speed'] . '</td>';
	$rows .= '<td>' . $row['temp'] . '</td>';
    $rows .= '<td>' . $row['humid'] . '</td>';
	$rows .= '<td>' . $row['updatetime'] . '</td>';

	$rows .= '</tr>';
}

// Return the HTML for the table rows
echo $rows;

// Close the database connection
mysqli_close($conn);
?>