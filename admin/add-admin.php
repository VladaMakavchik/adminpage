<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Добавить администратора</h1>

        <br> <br> 

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // вывод сообщения сессии 
                unset($_SESSION['add']); //удаление собщениня сессии
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Полное имя:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Введите полное имя"></input>
                    </td>
                </tr>

                <tr>
                    <td>Имя пользователя:</td>
                    <td>
                        <input type="text" name="username" placeholder="Введите имя пользователя"></input>
                    </td>
                </tr>

                <tr>
                    <td>Пароль:</td>
                    <td>
                        <input type="password" name="password" placeholder="Введите пароль"></input>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добавить администратора" class="btn btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //загрузка данных из базы данных и сохранение
    
    //проверка нажала ли кнопка

    if(isset($_POST['submit']))
    {
        // получение данных из таблицы
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // sql запросы чтобы сохранить данные в бд
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";
        
        // загрузка данных в бд

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // проверяем куда занеслись данные и выводим сообщение об этом
        if($res == TRUE)
        {
            $_SESSION['add'] = "Администратор добавлен успешно";
            // переход на менедж-админ
            header("location: http://localhost:8888/admin/manage-admin.php");

        }
        else
        {
            $_SESSION['add'] = "Не получилось добавить администратора";
            // переход на менедж-админ
            header("location: http://localhost:8888/admin/add-admin.php");
            
        }
    }
?>