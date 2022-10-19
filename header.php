<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>
<div class="container col-md-10 " style="font-size: large; font-weight: bold;">
    <nav class="navbar fixed-top mx-auto navbar-expand-lg navbar-light bg-light col-10">

        <div class="collapse navbar-collapse col-6" >
            <ul class="navbar-nav mr-8 mt-8 mt-lg-0">
            <li class="nav-item active">
                    <a href="profile.php" class="nav-link"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Trang chủ </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="member.php">Danh sách người dùng</a>
                </li>

                <li class="nav-item ">
                    <?php
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        if (isset($_SESSION['role'])) { 
                            $role=$_SESSION['role'];
                            if ($role === "1") 
                                echo '<a class="nav-link " href="teacher_exercise.php" >Bài tập</a>';
                            elseif ($role === "0") {
                                echo '<a class="nav-link " href="student_exercise.php" >Bài tập</a>';
                            }
                            else {
                                echo '<script language="javascript">alert("You must login first!"); window.location="login.php"</script>';
                            }
                        }
                    ?>
            
                </li>
                <li class="nav-item ">
                <?php
                    if (isset($_SESSION['role'])) { 
                        $role=$_SESSION['role'];
                        if ($role === "1") 
                                echo '<a class="nav-link " href="teacher_challenge.php" >Câu đố</a>';
                            elseif ($role === "0") {
                                echo '<a class="nav-link " href="student_challenge.php" >Câu đố</a>';
                            }
                            else {
                                echo '<script language="javascript">alert("You must login first!"); window.location="login.php"</script>';
                            }
                    }
                    
                ?>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse col-4" ></div>
<!--        <div class="col-2">
            <form >
                <input class="row form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success row" type="submit">Search</button>
            </form>
        </div>-->
        <div class="col-2"><a class="nav-link" href="logout.php">Đăng xuất</a>
        </div>
    </nav>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
</body>