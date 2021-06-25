<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Добавить блюдо</h1>

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
                    <td>Название:</td>
                    <td>
                        <input type="text" name="title" placeholder="Введите название"></input>
                    </td>
                </tr>

                <tr>
                    <td>Описание:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Введите описание категории" ></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Цена:</td>
                    <td>
                        <input type="number" name="price" placeholder="Введите цену"></input>
                    </td>
                </tr>

                <tr>
                    <td>Картинка:</td>
                    <td>
                        <input type="text" name="image_name" placeholder="Введите картинку"></input>
                    </td>
                </tr>

                <tr>
                    <td>Категория:</td>
                    <td>
                        <select name="category">

                            <?php
                                $sql = "SELECT * FROM tbl_category";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count>0)
                                {
                                    //есть категории
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id?>"><?php echo $title;?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //нет категорий
                                    ?>
                                    <option value="0">Нет категорий</option>
                                    <?php
                                }

                            ?>

                        </select>
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
    //загрузка данных из базы данных и сохранение
    
    //проверка нажала ли кнопка

    if(isset($_POST['submit']))
    {
        // получение данных из таблицы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_name = $_POST['image_name'];
        $category_id = $_POST['category_id'];

        // sql запросы чтобы сохранить данные в бд
        $sql = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category_id'
        ";
        
        // загрузка данных в бд

        $res = mysqli_query($conn, $sql);

        // проверяем куда занеслись данные и выводим сообщение об этом
        if($res == TRUE)
        {
            $_SESSION['add'] = "Блюдо добавлено успешно";
            // переход на менедж-админ
            header("location: http://localhost:8888/admin/manage-food.php");

        }
        else
        {
            $_SESSION['add'] = "Не получилось добавить блюдо";
            // переход на менедж-админ
            header("location: http://localhost:8888/admin/add-food.php");
            
        }
    }
?>