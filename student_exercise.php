<?php
    if(!isset($_SESSION)){
        session_start();
    }
	if (!isset($_SESSION['u']) || !isset($_SESSION['id'])) {
		echo '<script language="javascript">alert("You need login first!"); window.location="login.php"</script>';
	} else {
        $username_student = $_SESSION['u'];
        $userid = $_SESSION['id'];
    }

    include("db.php");

    $sql_get_assignments = "SELECT * FROM task";
    $get_assignment_result = $conn->query($sql_get_assignments);
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Exercise</title>
</head>
<body>
<?php include_once("header.php") ?>
    <div class="col-md-10 mx-auto container" style="margin-top:10%;">
        <h1>Exercise</h1>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">    
                <tr>
                    <th>Tên tệp</th>
                    <th>Ngày tạo</th>
                    <th>Bài nộp</th>
                    <th>Hành động</th>
                </tr>
            </thead>  
            <?php while ($get_assignment_row = mysqli_fetch_array($get_assignment_result)): ?>
                <tbody >
                    <tr>
                        <td><a href="<?php echo 'https://dungnbn.000webhostapp.com/'.$get_assignment_row['file']; ?>" download><?php echo $get_assignment_row['file']; ?></a></td>
                        <td><?php echo $get_assignment_row['time']; ?></td>
                        <?php 
                        $assignmentid =  $get_assignment_row['id'];
                        $sql_get_submit = "SELECT * FROM sub WHERE author = $userid AND assignmentid = $assignmentid";
                        $get_submit_result = $conn->query($sql_get_submit);
                        if (mysqli_num_rows($get_submit_result)===1) {
                            $submit_row = mysqli_fetch_array($get_submit_result);
                            $submit_title = $submit_row['title'];
                            $submit_link = $submit_row['file'];
                            echo '<td><a href="http://dungnbn.000webhostapp.com/'.$submit_link.'">'.$submit_title.'</a></td>';
                        }
                        else {
                            echo "<td></td>";
                        }
                        
                        ?> 
                        <td><a href="upload_exercise.php?assignmentid=<?php echo $get_assignment_row['id'];?>">Upload exercise</a></td>
                    </tr>
                </tbody>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>