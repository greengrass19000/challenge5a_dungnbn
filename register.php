<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
		
		<div class="info-res">
            <h2>Trang quản lý sinh viên HUST</h2> 
            <h3>One love, one future</h3>
        </div>    
        <div class="table-res">
			<h1>Đăng ký</h1>
			<form action="register.php" class="text-center" method='POST'>
                Username: <input class="input-res" type="text" name="username" placeholder="User Name" required/><br>
                Password: <input class="input-res" type="password" name="password" placeholder="Password" required/><br>
                Full name:  <input class="input-res" type="text" name="hoten" placeholder="Full name" required/><br>
                Email: <input class="input-res" type="email" name="email" placeholder="Email" required/><br>
                Phone: <input class="input-res" type="text" name="phone" placeholder="Phone" required/><br>
                <input type="submit" class="button" name="dangky" value='Đăng ký' />
                <div class="login"><a href="login.php">Log in</a></div>
			</form>
            
		</div>
	</div>

</body>
</html>

<?php

    require("db.php");

if(isset($_POST['dangky'])) {
    $username = $_POST['u'];
    $password = $_POST['p'];
    $hoten = $_POST['n'];
    $role = "0";

    $sql = "INSERT INTO users (username, password, hoten, email, phone, role) VALUES ('$username','$password','$hoten','$role')";
    if(mysqli_query($conn, $sql)) {
    echo '<script language="javascript">alert("Register successed!"); window.location="login.php"</script>'; }
}
?>