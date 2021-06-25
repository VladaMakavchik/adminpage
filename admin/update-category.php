<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Обновить категорию</h1>

        <br> <br>

        <?php
            // получение id выбранного админа
            $id=$_GET["id"];

            //sql запрос на получение деталей
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //доступны ли данные или нет
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //получаем информацию
                    $row=mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $image_name = $row['image_name'];
                }
                else
                {
                    // перевод на менедж категория
                    header("location: http://localhost:8888/admin/manage-category.php");
                }

            }
            
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Название категории:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Картинка:</td>
                    <td>
                        <input type="text" name="image_name" value="<?php echo $image_name; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Обновить категорию" class="btn btn-primary">
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
        //получение всех данных из бд для обновления
        $id = $_POST['id'];
        $title = $_POST['title'];
        $image_name = $_POST['image_name'];

        $sql = "UPDATE tbl_category SET
            title = '$title',
            image_name = '$image_name'
            WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //обновлен
            $_SESSION['update'] = "<div class='success'> Категория обновлена</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-category.php");
        }
        else
        {
            //не удалось
            $_SESSION['update'] = "<div class='error'> Не удалось обновить категорию</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-category.php");
        }
    }
?>



<?php include('partials/footer.php'); ?>