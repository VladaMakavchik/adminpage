<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Обновить блюдо</h1>

        <br> <br>

        <?php
            // получение id выбранного админа
            $id=$_GET["id"];

            //sql запрос на получение деталей
            $sql = "SELECT * FROM tbl_food WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //доступны ли данные или нет
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //получаем информацию
                    $row=mysqli_fetch_assoc($res);

                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    $category_id=$row['category_id'];
                }
                else
                {
                    // перевод на менедж админ
                    header("location: http://localhost:8888/admin/manage-food.php");
                }

            }
            
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Название:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Описание:</td>
                    <td>
                        <input type="text" name="description" value="<?php echo $description; ?>"></input>
                        
                    </td>
                </tr>

                <tr>
                    <td>Цена:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Картинка:</td>
                    <td>
                        <input type="text" name="image_name" value="<?php echo $image_name; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Категория:</td>
                    <td>
                    <!-- <input type="text" name="image_name" value="<?php echo $image_name; ?>"></input> -->
                        <!-- <select name="category">

                            <?php
                                // $sql2 = "SELECT * FROM tbl_category";
                                // $res2 = mysqli_query($conn, $sql2);
                                // $count2 = mysqli_num_rows($res2);
                                // if($count2>0)
                                // {
                                //     //есть категории
                                //     while($row2=mysqli_fetch_assoc($res2))
                                //     {
                                //         $id = $row['id'];
                                //         $title = $row['title'];
                                //         ?>
                                //         <option value="<?php //echo $id?>"><?php //echo $title;?></option>
                                //         <?php
                                //     }
                                // }
                                // else
                                // {
                                //     //нет категорий
                                //     ?>
                                //     <option value="0">Нет категорий</option>
                                //     <?php
                                // }

                            ?>

                        </select> -->

                        <input type="number" name="category_id" value="<?php echo $category_id; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Обновить блюдо" class="btn btn-primary">
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
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_name = $_POST['image_name'];
        $category_id = $_POST['category_id'];

        $sql = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category_id'
            WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //обновлен
            $_SESSION['update'] = "<div class='success'> Блюдо обновлено</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-food.php");
        }
        else
        {
            //не удалось
            $_SESSION['update'] = "<div class='error'> Не удалось обновить блюдо</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-food.php");
        }
    }
?>



<?php include('partials/footer.php'); ?>