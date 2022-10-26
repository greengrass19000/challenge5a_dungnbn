<?php
    include_once("db.php")
    ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php require_once("header.php"); ?>
<div class="container col-10 mx-auto" style="margin-top:12vh; padding-top:10vh;">
<form method="post" action="add_user.php" class="form" >

    <h4>Thêm người dùng mới</h4>

    Username: <input type="text" name="un" value="" required/>

    Password: <input type="text" name="pw" value="" required/>

    Họ và tên: <input type="text" name="name" value="" required/>

    <input type="submit" class="button" name="adduser" value="Thêm"/>
</form>
</div>
</body>
</html>

<?php
// Dùng isset để kiểm tra Form
if(isset($_POST['adduser'])) {
    $username = $_POST['un'];
    $password = $_POST['pw'];
    $hoten = $_POST['name'];

    $sql = "INSERT INTO acc (id, un, pw, name, role) VALUES (NULL, '$username','$password','$hoten', '0')";
    console.log("$sql");
    mysqli_query($conn, $sql);
    echo '<script language="javascript">alert("Add user successed!"); window.location="student.php"</script>';
}
?>