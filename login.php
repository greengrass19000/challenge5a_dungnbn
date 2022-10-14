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

/* @var $_POST type */
$uu = filter_input(INPUT_POST, 'u');
$pp = filter_input(INPUT_POST, 'p');
echo $uu;
echo $pp;
$sql = "SELECT id, r FROM acc WHERE un='{$uu}' AND pw='{$pp}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["id"];
//    echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
} else {
    echo "$uu";
    echo "$pp";
}
$conn->close();
?>