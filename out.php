<?php
session_start();
$p=session_destroy();
if ($p)
{
	header("Location: index.php");}



?>