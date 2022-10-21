<?php
include("db.php");
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['u'])) {
    $u = $_SESSION['u'];
    $sql = "SELECT un, id, role, name FROM acc WHERE role = 1";
    $result = $conn->query($sql);
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
        <h2>Danh sách giáo viên</h2>
        <table class="table table-bordered">
            <tr style="text-align:center">
                <th>Username</th>
                <th>Họ và tên</th>
                <th>Tùy chọn</th>
            </tr>

            <?php while ($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td style="width: 500px"><?php echo htmlspecialchars($row['un']); ?></td>
                    <td style="width: 500px"><?php echo htmlspecialchars($row['name']); ?></td>
                    <td style="text-align: center"><button><a href="profile.php?id=<?php echo $row['id']; ?>">Xem chi tiết</a></button>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>


