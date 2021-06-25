<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Обновить администратора</h1>

        <br> <br>

        <?php
            // получение id выбранного админа
            $id=$_GET["id"];

            //sql запрос на получение деталей
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //доступны ли данные или нет
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //получаем информацию
                    // echo "Админ доступен";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                    $password = $row['password'];
                }
                else
                {
                    // перевод на менедж админ
                    header("location: http://localhost:8888/admin/manage-admin.php");
                }

            }
            // else
            // {

            // }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Полное имя:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Имя пользователя:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>"></input>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Обновить администратора" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //нажата кнопка или нет
    if($_POST['submit'])
    {
        // echo "Кнопка нажата";
        //получение всех данных из бд для обновления
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //обновлен
            $_SESSION['update'] = "<div class='success'> Администратор обновлен</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-admin.php");
        }
        else
        {
            //не удалось
            $_SESSION['update'] = "<div class='error'> Не удалось обновить администратора</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-admin.php");
        }
    }
?>



<?php include('partials/footer.php'); ?>