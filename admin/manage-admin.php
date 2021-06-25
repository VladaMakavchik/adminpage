<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1> АДМИНИСТРАТОР </h1>
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
                <!-- <br> -->
                <br> <br> <br>

                <!-- кнопки для добавления администраторов -->
                <a href="add-admin.php" class="btn-primary">Добавить Администратора</a>

                <br /> <br /> <br />

                <table class="tbl-full">
                    <tr>
                        <th>Серийный номер</th>
                        <th>Имя</th>
                        <th>Логин</th>
                        <th>Действия</th>
                    </tr>

                    <?php
                        // вывод данных из таблицы админ
                        $sql="SELECT * FROM tbl_admin";
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
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //вывод на экран
                                    ?>

                                    <tr>
                                        <td> <?php echo $id; ?> </td>
                                        <td> <?php echo $full_name; ?> </td>
                                        <td> <?php echo $username; ?></td>
                                        <td>
                                            <a href="http://localhost:8888/admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Обновить администратора</a>
                                            <a href="http://localhost:8888/admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Удалить администратора</a>
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