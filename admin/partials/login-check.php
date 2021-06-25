<?php
    //контроль доступа
    //проверка авторизован пользователь или нет
    if(!isset($_SESSION['user'])) //если пользователь не авторизован
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Авторизуйтесь, чтобы получить доступ к странице администратора</div>";
        header("location: http://localhost:8888/admin/login-admin.php");
    }
?>