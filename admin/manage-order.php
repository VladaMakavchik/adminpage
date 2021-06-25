<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ЗАКАЗЫ</h1>

        <br />

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // вывод сообщения сессии 
                unset($_SESSION['add']); //удаление собщениня сессии
            }
        ?>
        <br>

        <!-- <br /> <br /> <br /> -->

        <table class="tbl-full">
            <tr>
                <th>Серийный номер</th>
                <th>Блюдо</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Заказчик</th>
                <th>Компания</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>

            <?php
                // вывод данных из таблицы админ
                $sql="SELECT * FROM tbl_order";
                $res=mysqli_query($conn, $sql);

                //проверка
                // if($res==TRUE)
                // {
                    // считает количество строк в бд
                    $count=mysqli_num_rows($res); // получение всех строк в дб

                    // проверяем количесвто строк
                    if($count>0)
                    {
                        //у нас есть данные в дб
                        while($row=mysqli_fetch_assoc($res))
                        {
                            // используем while чтобы получить все данные из дб

                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $custumer_name=$row['custumer_name'];
                            $company=$row['company'];
                            $status=$row['status'];

                            if($status=="Заказан")
                            {

                            //вывод на экран
                            ?>

                            <tr>
                                <td> <?php echo $id; ?> </td>
                                <td> <?php echo $food; ?> </td>
                                <td> <?php echo $price; ?> </td>
                                <td> <?php echo $qty; ?> </td>
                                <td> <?php echo $custumer_name; ?> </td>
                                <td> <?php echo $company; ?> </td>
                                <td> <?php echo $status; ?></td>
                                <td>
                                    <a href="http://localhost:8888/admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Обновить заказ</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    }
                    else
                    {
                        //у нас нет данных в дб
                    }
                // }
            ?>



    
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>