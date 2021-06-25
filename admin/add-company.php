<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Добавить компанию</h1>

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
                    <td>Название компании:</td>
                    <td>
                        <input type="text" name="company_name" placeholder="Введите название компании"></input>
                    </td>
                </tr>

                <tr>
                    <td>Адрес:</td>
                    <td>
                        <input type="text" name="adress" placeholder="Введите адрес компании"></input>
                    </td>
                </tr>

                <tr>
                    <td>Контактный телефон:</td>
                    <td>
                        <input type="number" name="tel" placeholder="Введите телефон"></input>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добавить компанию" class="btn btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //загрузка данных из базы данных и сохранение
    
    //проверка нажала ли кнопка (??)

    if(isset($_POST['submit']))
    {
        // получение данных из таблицы
        $company_name = $_POST['company_name'];
        $adress = $_POST['adress'];
        $tel = $_POST['tel'];

        // sql запросы чтобы сохранить данные в бд
        $sql = "INSERT INTO tbl_company SET
            company_name = '$company_name',
            adress = '$adress',
            tel = '$tel'
        ";
        
        // загрузка данных в бд

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // проверяем куда занеслись данные и выводим сообщение об этом
        if($res == TRUE)
        {
            $_SESSION['add'] = "Компания добавлена успешно";
            // переход на менедж-админ
            header("location: http://localhost:8888/admin/manage-company.php");

        }
        else
        {
            $_SESSION['add'] = "Не получилось добавить компанию";
            // переход на менедж-админ
            header("location: http://localhost:8888/admin/add-company.php");
            
        }
    }
?>