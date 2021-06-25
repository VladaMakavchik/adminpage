<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Добавить категорию</h1>

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
                    <td>Название категории:</td>
                    <td>
                        <input type="text" name="title" placeholder="Введите название категории"></input>
                    </td>
                </tr>

                <tr>
                    <td>Изображение:</td>
                    <td>
                        <input type="text" name="image_name" placeholder="Ссылка на картинку"></input>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добавить категорию" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //проверка нажала ли кнопка
    if(isset($_POST['submit']))
    {
        // получение данных из таблицы
        $title = $_POST['title'];
        $image_name = $_POST['image_name'];

        // sql запросы чтобы сохранить данные в бд
        $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name = '$image_name'
        ";

        $res = mysqli_query($conn, $sql);

        // проверяем куда занеслись данные и выводим сообщение об этом
        if($res == TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Категория добавлена успешно</div>";
            // переход на менедж-категори
            header("location: http://localhost:8888/admin/manage-category.php");
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Не получилось добавить категорию</div>";
            // переход на менедж-категори
            header("location: http://localhost:8888/admin/add-category.php");
        }
    }
?>