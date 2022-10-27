<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['u'])) {
    echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
} else {
    $username_student = $_SESSION['u'];
}
include("db.php");

$sql_challenge = "SELECT *, quiz.name as nam FROM quiz JOIN acc ON quiz.author=acc.id";
$result = $conn->query($sql_challenge);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title>Challenge</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    </head>
    <body>
        <?php include_once("header.php") ?>
        <div class="col-md-10 mx-auto container" style="margin-top:10%;">
            <h1>Danh sách challenges của bạn</h1>
            <form action="student_challenge.php" method="post">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Tên Challenge</th>
                        <th>Gợi ý</th>
                        <th>Teacher</th>
                        <th>Answer</th>
                    </tr>
                    <?php $cnt = 0; ?>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <?php $cnt = $cnt + 1; ?>
                        <tr>
                            <td><?php echo $row['nam']; ?></td>
                            <td><?php echo $row['hint']; ?></td>
                            <td><?php echo $row['un']; ?></td>
                            <td>

                                <input type="text" name="answer<?php echo $cnt ?>" size="100">
                                <input type="submit" name="submit" value="Submit">
                                <?php
                                if (isset($_POST['answer' . $cnt])) {
                                    $answer = $_POST['answer' . $cnt];
                                    $realanswer = basename($row['file'], '.txt');
                                    if ($answer == $realanswer) {
                                        echo '<h3 style=" text-color: green;"> Bạn đã trả lời ĐÚNG!</h3>';

                                        $content = fopen($row['file'], "r");
                                        while (!feof($content)) {
                                            echo htmlspecialchars(fgets($content), ENT_QUOTES, 'UTF-8') . "<br>";
                                        }
                                        fclose($content);
                                    } elseif ($answer != '') {
                                        echo '<h3 style=" text-color: red;"> Bạn trả lời SAI!</h3>';
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </form>
            <div>
                </body>
                </html>