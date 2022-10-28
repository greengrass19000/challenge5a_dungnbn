<?php
require("db.php");

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['u'])) {
    echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
} else {
    $username_teacher = $_SESSION['u'];
    $sql_get_teacher_id = "SELECT id FROM acc where un = '$username_teacher'";
    $result = $conn->query($sql_get_teacher_id);
    $count = mysqli_num_rows($result);
    if ($count !== 1) {
        exit();
    }
    $row = mysqli_fetch_array($result);
    $teacherId = $row['id'];
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$exercise_date = date('l jS F Y h:i:s A');
if (isset($_POST["submit"])) {
    $exercise_dir = "uploads/teacher_assignment/";
    $exercise_file = $exercise_dir . basename($_FILES["exercise"]["name"]);
    $uploadOk = 1;
    $exercise_type = strtolower(pathinfo($exercise_file, PATHINFO_EXTENSION)); // type of exercise
    $exercise_name = $_FILES['exercise']['name']; // name of exercise   
    // Check if file already exists
    if (file_exists($exercise_file)) {
        echo '<script language="javascript"> alert("Sorry, file already exists.") </script>';
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($exercise_type != "pdf") {
        echo '<script language="javascript"> alert("Sorry, only PDF files are allowed.") </script>';
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x2)") </script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["exercise"]["tmp_name"], $exercise_file)) {

            //echo($exercise_date);
            $sql_upload_exercise = "INSERT INTO task (name, time, file, author) VALUES ('$exercise_name', '$exercise_date', '$exercise_file', $teacherId)";
            if ($conn->query($sql_upload_exercise)) {
                echo '<script language="javascript"> alert("Upload exercise success!") </script>';
            } else {
                echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x0)") </script>';
            }
        } else {
            echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x1)") </script>';
        }
    }
}
$sql_get_submit_exercise = "SELECT * FROM task WHERE author = '$teacherId'";
$result_get_submit_exercise = $conn->query($sql_get_submit_exercise);
?>
<head>
    <title>View Exercise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>
    <?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto container" style="margin-top:10%;">
        <h1>Danh sách bài tập</h1>



        <table class="table table-bordered table-hover">
            <tbody >
                <?php
                while ($row_get_submit_exercise = mysqli_fetch_array($result_get_submit_exercise)):
                    $assignmentid = $row_get_submit_exercise['id'];
                    ?>
                    <tr>
                        <th>Tên bài</th>
                        <th>Tệp bài</th>
                        <th>Ngày tạo</th>
                    </tr>
                    <tr>
                        <td><?php echo $row_get_submit_exercise['name']; ?></td>
                        <td><a href="<?php echo 'https://dungnbn.000webhostapp.com/' . $row_get_submit_exercise['file']; ?>" download><?php echo $row_get_submit_exercise['file']; ?></a></td>
                        <td><?php echo $row_get_submit_exercise['time']; ?></td>
                    </tr>  
                        <tr> 
                            <th>Tên học sinh</th>
                            <th>Đường dẫn tệp</th>
                            <th>Thời gian nộp</th>
                        <tr>
                        <?php
                        $sql_get_student_submit = "SELECT * FROM sub JOIN acc ON sub.author=acc.id AND sub.assignmentid=" . $assignmentid . "";
                        $result_get_student_submit = $conn->query($sql_get_student_submit);
                        while ($row_get_student_submit = mysqli_fetch_array($result_get_student_submit)):
                            ?>
                            <tr>
                                <td> <?php echo $row_get_student_submit['un']; ?> </td>
                                <td><a href ="<?php echo 'https://dungnbn.000webhostapp.com/' . $row_get_student_submit['file']; ?>" download><?php echo $row_get_student_submit['file']; ?></a></td>
                                <td> <?php echo $row_get_student_submit['time']; ?> </td>
                            </tr>
                        <?php endwhile; ?>
                <br>
            <?php endwhile; ?>
            </tbody>
        </table>

        <h1>Đăng bài tập mới</h1>
        <form action="teacher_exercise.php" method="post" enctype="multipart/form-data">
            <p>Chọn tệp để tải lên:</p>
            <input type="file" name="exercise">
            <input type="submit" name="submit" value="Upload">
        </form>

    </div>
</body>
