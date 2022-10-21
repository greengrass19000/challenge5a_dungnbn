

<!DOCTYPE html>
<html>
    <head>
      <title>Đăng nhập</title>
     <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.min.js"></script>
    </head>
    <body>
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <div class="text-white mb-3 mb-md-0">
                Loginpage
            </div>
        </div>
        <br>
        <br>
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="login.php" method="post">

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">Tài khoản</label>
                                <input type="text" name="u" class="form-control form-control-lg"
                                       placeholder="username" />
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="form3Example4">Mật khẩu</label>
                                <input type="password" name="p" class="form-control form-control-lg"
                                       placeholder="*********" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                    <label class="form-check-label" for="form2Example3">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" name="log" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;"
                                        >Login</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <?php
            require 'db.php';
            if (isset($_POST['log'])) {
                mysqli_set_charset($conn, 'UTF8');
                include_once('db.php');
                $sql = "SELECT id, role FROM acc WHERE un='{$_POST['u']}' AND pw='{$_POST['p']}'";
                $result = $conn->query($sql);
                    
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    session_start();
                    $_SESSION['u'] = $_POST['u'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['id'] = $row['id'];
                    header("location:index.php");
                } else {
                    echo "not suitable input";
                }
                $conn->close();
            }
            ?>
            <br>
            <br>
            <br>
            <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <div class="text-white mb-3 mb-md-0">
                    Challenge5a
                </div>
            </div>
        </section>
    </body>
</html>

