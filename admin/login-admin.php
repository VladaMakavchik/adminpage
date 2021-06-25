<?php include('../config/constants.php'); ?>

<html>
    <head>
        <meta charset="utf-8">
        <title> Авторизация администратора </title>
        <link rel = "stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Авторизация</h1>
            <br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login']; 
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message']; 
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- авторизация начинается здесь -->
            <form action="" method="POST" class="text-center">
                Имя пользователя: <br>
                <input type="text" name="username" placeholder="Введите имя пользователя"><br><br>
                Пароль:<br>
                <input type="password" name="password" placeholder="Введите пароль"><br> <br>

                <input type="submit" name="submit" value="Login" class="btn btn-primary">
            <br><br>
            </form>
            
        </div>
    </body>
</html>

<?php
    //нажата кнопка или нет
    if(isset($_POST['submit']))
    {
        //процесс авторизации
        //получение данных из формы
        $username = $_POST['username'];
        $password = $_POST['password'];

        //проверка имеется ли такой пользователь или нет
        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password ='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //имеется пользователь
            $_SESSION['login'] = "<div class='success'>Авторизация прошла успешно</div>";
            $_SESSION['user'] = $username;
            
            header("location: http://localhost:8888/admin/manage-admin.php");
        }
        else
        {
            //такого пользователя нет
            $_SESSION['login'] = "<div class='error text-center'>имя пользователя или пароль неверные</div>";
            header("location: http://localhost:8888/admin/login-admin.php");
        }
    }
?>