<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý thông tin sinh viên</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>

<body>

<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    if (isset($_SESSION['u'])) {
        echo '<script language="javascript">window.location="user-info.php"</script>';
    } else {
        echo '<script language="javascript">window.location="login.php"</script>';
    }
?>
</body>
</html>