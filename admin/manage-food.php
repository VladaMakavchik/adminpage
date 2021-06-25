<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>МЕНЮ</h1>

        <br />

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // вывод сообщения сессии 
                unset($_SESSION['add']); //удаление собщениня сессии
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        
        <br> <br> <br>

        <!-- кнопки для добавления блюд -->
        <a href="add-food.php" class="btn-primary">Добавить Блюдо</a>

        <br /> <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>Серийный номер</th>
                <th>Блюдо</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Картинка</th>
                <th>Действия</th>
            </tr>

            <?php
                // вывод данных из таблицы админ
                $sql="SELECT * FROM tbl_food";
                $res=mysqli_query($conn, $sql);

                //проверка
                if($res==TRUE)
                {
                    // считает количество строк в бд
                    $count=mysqli_num_rows($res); // получение всех строк в дб

                    // проверяем количесвто строк
                    if($count>0)
                    {
                        //у нас есть данные в дб
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            // используем while чтобы получить все данные из дб

                            $id=$rows['id'];
                            $title=$rows['title'];
                            $description=$rows['description'];
                            $price=$rows['price'];
                            $image_name=$rows['image_name'];
                            
                            //вывод на экран
                            ?>

                            <tr>
                                <td> <?php echo $id; ?> </td>
                                <td> <?php echo $title; ?> </td>
                                <td> <?php echo $description; ?> </td>
                                <td> <?php echo $price; ?> </td>
                                <td> 
                                    <img src = '../images/menu/<?php echo $image_name; ?>.jpg' width="100px" alt="" >
                                </td>
                                <td>
                                    <a href="http://localhost:8888/admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Обновить блюдо</a> <br> <br>
                                    <a href="http://localhost:8888/admin/delete-food.php?id=<?php echo $id; ?>" class="btn-danger">Удалить блюдо</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //у нас нет данных в дб
                    }
                }
            ?>

        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>