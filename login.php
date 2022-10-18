<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "w";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$uu = $_POST['u'];
$pp = $_POST['p'];
$sql = "SELECT id, r FROM acc WHERE un='{$uu}' AND pw='{$pp}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["id"];
//    echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
} else {
    echo "Account not found";
}
$conn->close();
?>