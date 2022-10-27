<?php
	if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['u'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_teacher = $_SESSION['u'];
    }
    if (!isset($_SESSION['id'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $teacherId = $_SESSION['id'];
    }
	include("db.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $challenge_date = date('l jS F Y h:i:s A');
    if(isset($_POST["submit"])) {
        $title = $_POST['title'];
        $goiy = $_POST['goiy'];
        $challenge_dir = "uploads/challenge/";
        $challenge_file = $challenge_dir . basename($_FILES["challenge"]["name"]);
        $uploadOk = 1;
        $challenge_type = strtolower(pathinfo($challenge_file,PATHINFO_EXTENSION));
    
        if (file_exists($challenge_file)) {
            echo '<script language="javascript"> alert("Sorry, file already exists.") </script>';
            $uploadOk = 0;
        }
    
        if($challenge_type != "txt") {
            echo '<script language="javascript"> alert("Sorry, only .txt files are allowed.") </script>';
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo '<script language="javascript"> alert("Sorry, there was an error uploading your file (0x2)") </script>';
        } else {
            if (move_uploaded_file($_FILES["challenge"]["tmp_name"], $challenge_file)) {
                $sql_upload_challenge = "INSERT INTO quiz (author, name, file, hint, time) VALUES ($teacherId, '$title', '$challenge_file', '$goiy','$challenge_date')";
                if($conn->query($sql_upload_challenge)) {
                    echo '<script language="javascript"> alert("Upload challenge success!") </script>';
                }              
                else {
                echo '<script language="javascript">alert("Sorry, there was an error update your database."); window.location="teacher_challenge.php"</script>';
                }
            }
        }
    }
    $sql_get_challenge = "SELECT * FROM quiz WHERE author=$teacherId";
    $result_get_challenge = $conn->query($sql_get_challenge);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Upload challenge</title>
</head>
<body>
<?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto " style="margin-top:10%;">
        <h1>Danh sách câu đố</h1>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Câu đố</th>
                    <th>Gợi ý</th>
                    <th>Tệp tin</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <?php while ($row_get_challenge = mysqli_fetch_array($result_get_challenge)): ?>
                <tbody >
                    <tr>
                        <td><?php echo $row_get_challenge['name']; ?></td>
                        <td><?php echo $row_get_challenge['hint']; ?></td>
                        <td><a href="<?php echo 'http://localhost/p/'.$row_get_challenge['file']; ?>" download><?php echo $row_get_challenge['file']; ?></a></td>
                        <td><?php echo $row_get_challenge['time']; ?></td>
                    </tr>
                </tbody>
            <?php endwhile; ?>
        </table>

        <h1>Tạo câu đố mới</h1>
        <form action="teacher_challenge.php" method="post" enctype="multipart/form-data">
            Tên câu đố:<br>
            <input type="text" name="title" required> <br>
            Gợi ý cho câu đố:<br>
            <textarea type="text" name="goiy" rows="5" cols="80"></textarea>
            <br>
            <p>Chọn tệp để tải lên:</p>
            <input type="file" name="challenge">
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
</body>
</html>
