<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['u']) || !isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
} else {
//        $username_avatar = $_SESSION['username'];
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
}

if (isset($_GET['id'])) {
    $requestid = $_GET['id'];
}

//verify permission
if ($role === '1') {
    $approved = true;
} else if ($id === $requestid) {
    $approved = true;
} else {
    $approved = false;
    echo '<script language="javascript">alert("You are not allowed to do that"); window.location="login.php"</script>';
}

include("db.php");

$sql = "SELECT * FROM acc WHERE id = " . $requestid;
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title>List</title>
    </head>
    <body>
        <?php include("header.php") ?>

        <?php
        require("debug.php");
        require("redirect.php");

        if (isset($_POST["submit"])) {
            $password = $_POST["password"];
            if (!isset($_POST['fullname'])) {
                $fullname = $row['hoten'];
            } else {
                $fullname = $_POST["fullname"];
            }
            if (!isset($_POST['username'])) {
                $username_edit = $row['username'];
            } else {
                $username_edit = $_POST['username'];
            }

            $sql_update = "UPDATE acc SET un = '$username_edit', name = '$fullname', pw = '$password' WHERE id = $requestid";

            if ($conn->query($sql_update)) {
                echo '<script language="javascript">alert("Profile edited!")</script>';
                back();
            } else {
                echo '<script language="javascript">alert("Error update database!"); window.location="profile.php"</script>';
            }
        }
        ?>

        <?php
        echo '<form action="edit_profile.php?id=' . $requestid . '" method="post">';
        ?>
        <table>
            <tr>	
                <td>
                    <h3>Edit information of user</h3>
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <?php
                if ($role === "1") {
                    echo '<td><input type="text" name="username" required value="' . $row['un'] . '"></td>';
                } else {
                    echo '<td><input type="text" name="username" required value="' . $row['un'] . '" disabled=""></td>';
                }
                ?>	

            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="text" name="password" required value="<?php echo $row['pw']; ?>"></td>
            </tr>
            <td>Họ và tên:</td>
            <?php
            if ($role === "1") {
                echo '<td><input type="text" name="fullname" required value="' . $row['name'] . '"></td>';
            } else {
                echo '<td><input type="text" name="fullname" required value="' . $row['name'] . '" disabled=""></td>';
            }
            ?>
            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>

        </table>
    </form>
</div>
</body>
</html>
