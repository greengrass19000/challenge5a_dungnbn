<?php
include("db.php");
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['u'])) {
    $u = $_SESSION['u'];
    $sql = "SELECT un, id, role FROM acc WHERE un = '$u'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    $sql_student = "SELECT un, name, role, id FROM acc WHERE role = 0";
    $result_student = $conn->query($sql_student);
} else {
    echo '<script language="javascript">window.location="login.php"</script>';
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    </head>
    <?php include("header.php") ?>
    <div class="col-md-10 mx-auto" style="margin-top: 10%;">
        <h2>Danh sách học sinh</h2>
        <?php
        if ($row['role'] === "1") {
            echo '<a href="add_user.php"> <button style="width: 200px; margin-bottom: 20px" type="button" > <i class="fa fa-plus"></i> Thêm mới</button></a>';
        }
        ?>
        <table class="table table-bordered">
            <tr style="text-align:center">
                <th>Username</th>
                <th>Họ và tên</th>
                <th colspan=3 >Tùy chọn</th>
            </tr>

            <?php while ($row = mysqli_fetch_array($result_student)): ?>
                <tr>
                    <td style="width: 500px"><?php echo htmlspecialchars($row['un']); ?></td>
                    <td style="width: 500px"><?php echo htmlspecialchars($row['name']); ?></td>
                    <td style="text-align: center"><button><a href="profile.php?id=<?php echo $row['id']; ?>">Xem chi tiết</a></button>
                    <td style="text-align: center"><button><a href="edit_profile.php?id=<?php echo $row['id']; ?>">Chỉnh sửa</a></button>
                    <td style="text-align: center"><button><a href="profile.php?id=<?php echo $row['id']; ?>&action=delete">Xóa user</a></button>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>


