<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['u']) || !isset($_SESSION['id']) || !isset($_SESSION['role'])) {
   echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
} else {
    $u = $_SESSION['u'];
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

include("db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Info</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="col-md-6 mx-auto">
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Tên đăng nhập</td>
                    <td><?php echo $u; ?></td>
                </tr>
                <tr>
                    <td>ID</th>
                    <td><?php echo $id; ?></td>
                </tr>
                <tr>
                    <td>Kiểu tài khoản</td>
                    <td><?php echo $role; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
