<?php
    session_start();
    unset($_SESSION['u']);
    unset($_SESSION['id']);
    unset($_SESSION['role']);
    session_destroy();
    echo '<script language="javascript">window.location="login.php"</script>';
?>