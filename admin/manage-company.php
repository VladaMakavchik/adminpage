<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>КОМПАНИИ</h1>

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
        <a href="add-company.php" class="btn-primary">Добавить Администратора</a>

        <br /> <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>Серийный номер</th>
                <th>Название компании</th>
                <th>Адрес</th>
                <th>Контактный телефон</th>
                <th>Действия</th>
            </tr>

            <?php
                // вывод данных из таблицы админ
                $sql="SELECT * FROM tbl_company";
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
                            $company_name=$rows['company_name'];
                            $adress=$rows['adress'];
                            $tel=$rows['tel'];

                            //вывод на экран
                            ?>

                            <tr>
                                <td> <?php echo $id; ?> </td>
                                <td> <?php echo $company_name; ?> </td>
                                <td> <?php echo $adress; ?> </td>
                                <td> <?php echo $tel; ?> </td>
                                <td>
                                    <a href="http://localhost:8888/admin/update-company.php?id=<?php echo $id; ?>" class="btn-secondary">Обновить компанию</a>
                                    <a href="http://localhost:8888/admin/delete-company.php?id=<?php echo $id; ?>" class="btn-danger">Удалить компанию</a>
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