<?php
include 'debug.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['u']) || !isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
} else {
    $username = $_SESSION['u'];
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
}
if (isset($_GET['id'])) {
    $requestid = $_GET['id'];
} else {
    $requestid = $id;
}
//verify permission
$self = false;

if ($role === '1') {
    $approved = true;
} else if ($id === $requestid) {
    $approved = true;
} else {
    $approved = false;
}
if ($id === $requestid) {
    $self = true;
}

include("db.php");
require("redirect.php");
//require("debug.php");
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'delete') {
        if (!$self) {                       //user can not delete their account
            if ($role === '1') {      //user must be teacher  
                $sql_get_user_file = "SELECT * FROM task WHERE author=$requestid";
                $result_get_user_file = $conn->query($sql_get_user_file);
                while ($fetched_row = mysqli_fetch_array($result_get_user_file)) {
                    $file = $fetched_row['files'];
                    unlink($file);
                }

                $sql_get_user_file = "SELECT * FROM quiz WHERE author=$requestid";
                $result_get_user_file = $conn->query($sql_get_user_file);
                while ($fetched_row = mysqli_fetch_array($result_get_user_file)) {
                    $file = $fetched_row['files'];
                    unlink($file);
                }

                $sql_get_user_file = "SELECT * FROM sub WHERE author=$requestid";
                $result_get_user_file = $conn->query($sql_get_user_file);
                while ($fetched_row = mysqli_fetch_array($result_get_user_file)) {
                    $file = $fetched_row['link'];
                    unlink($file);
                }

                $sql_get_user_challenge = "SELECT * FROM quiz WHERE author=$requestid";
                $sql_get_user_submit = "SELECT * FROM sub WHERE author=$requestid";

                $sql_delete_user = "DELETE FROM acc WHERE id=$requestid";
                $sql_delete_user_message = "DELETE FROM mess WHERE sender=$requestid OR receiver=$requestid";
                $sql_delete_user_assignment = "DELETE FROM task WHERE author=$requestid";
                $sql_delete_user_challenge = "DELETE FROM quiz WHERE author=$requestid";
                $sql_delete_user_submit = "DELETE FROM sub WHERE author=$requestid";
                if (!$conn->query($sql_delete_user)) {
                    //breakpoint($sql_delete_user);
                    echo '<script language="javascript">alert("Some error occured while deleting user! (0x0)")</script>';
                }
                if (!$conn->query($sql_delete_user_message)) {
                    echo '<script language="javascript">alert("Some error occured while deleting user! (0x1)")</script>';
                }
                if (!$conn->query($sql_delete_user_assignment)) {
                    echo '<script language="javascript">alert("Some error occured while deleting user! (0x2)")</script>';
                }
                if (!$conn->query($sql_delete_user_challenge)) {
                    echo '<script language="javascript">alert("Some error occured while deleting user! (0x3)")</script>';
                }
                if (!$conn->query($sql_delete_user_submit)) {
                    echo '<script language="javascript">alert("Some error occured while deleting user! (0x4)")</script>';
                }

                echo '<script language="javascript">alert("User deleted!")</script>';
                back();
            } else {
            echo '<script language="javascript">alert("You do not have the permisson!!")</script>';
            }
        } else {
            echo '<script language="javascript">alert("Can not delete your own account!!")</script>';
        }
    }
}
?>

<html>
    <head>
    </head>
    <body>
        <?php include("header.php") ?>
        <div class="container col-md-10 mx-auto">
            <h1>Profile</h1>
            <?php
            $sql = "SELECT * FROM acc WHERE id = $requestid";
            $result = $conn->query($sql);
            $row = mysqli_fetch_array($result);
            ?>
            <div class="col-md-6 mx-auto">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>T??n ????ng nh???p</td>
                        <td><?php echo $row['un']; ?></td>
                    </tr>
                    <tr>
                        <td>H??? v?? t??n</th>
                        <td><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Ki???u t??i kho???n</td>
                        <td><?php echo $row['role']; ?></td>
                    </tr>
                </table>
            </div>

            <?php
            if ($approved === true) {
                echo '<div class="col-md-1 col-xs-1 col-lg-1 mx-auto">';
                echo '<button>';
                echo '<a href="edit_profile.php?id=' . $requestid . '">Edit</a>';
                echo '</button>';
                echo '</div>';
            }
            ?>
        </div>

        <?php
        if (!$self) {
            require_once("send_message.php");
        }
        ?>

        <?php
        //get message
        if ($self) {
            $sql_get_message = "SELECT * FROM mess WHERE receiver = $id";
        } else {
            $sql_get_message = "SELECT * FROM mess WHERE receiver = $requestid AND sender = $id";
        }
        $result_get_message = $conn->query($sql_get_message);
        ?>

        <div class="container col-md-10 mx-auto" <?= isset($_GET['id']) ? '' : 'style="display:none"' ?>>
            <table class="table table-bordered table-striped">
                <tr style="text-align:center">
                    <td>N???i dung tin nh???n   
                    <td>Th???i gian
                    <td colspan="<?= $self ? 1 : 2 ?>">H??nh ?????ng
                </tr>

                <?php while ($message_record = mysqli_fetch_array($result_get_message)): ?>
                    <tr>
                        <td><?= $message_record['content'] ?>
                        <td><?= $message_record['time'] ?>
                            <?php
                            if (!$self)
                                echo '<td style="text-align: center"><button><a href="edit_message.php?id=' . $message_record['id'] . '">Ch???nh s???a</a></button>';
                            ?>
                        <td style="text-align: center"><button><a href="edit_message.php?id=<?= $message_record['id'] ?>&action=delete">X??a</a></button>
                    </tr>
                <?php endwhile; ?>

            </table>
        </div>

    </body>