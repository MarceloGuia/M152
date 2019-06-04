<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
// Create connection
$conn = new mysqli("localhost", "root", "", "m152");

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}


?>
