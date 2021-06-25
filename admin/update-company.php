<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Обновить компанию</h1>

        <br> <br>

        <?php
            // получение id выбранного админа
            $id=$_GET["id"];

            //sql запрос на получение деталей
            $sql = "SELECT * FROM tbl_company WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //доступны ли данные или нет
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //получаем информацию
                    $row=mysqli_fetch_assoc($res);

                    $company_name = $row['company_name'];
                    $adress = $row['adress'];
                    $tel = $row['tel'];
                }
                else
                {
                    // перевод на менедж админ
                    header("location: http://localhost:8888/admin/manage-company.php");
                }

            }
            
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Название компании:</td>
                    <td>
                        <input type="text" name="company_name" value="<?php echo $company_name; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Адрес:</td>
                    <td>
                        <input type="text" name="adress" value="<?php echo $adress; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Контактный телефон:</td>
                    <td>
                        <input type="number" name="tel" value="<?php echo $tel; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Обновить компанию" class="btn btn-primary">
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
        $company_name = $_POST['company_name'];
        $adress = $_POST['adress'];
        $tel = $_POST['tel'];

        $sql = "UPDATE tbl_company SET
            company_name = '$company_name',
            adress = '$adress',
            tel = '$tel'
            WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //обновлен
            $_SESSION['update'] = "<div class='success'> Администратор обновлен</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-company.php");
        }
        else
        {
            //не удалось
            $_SESSION['update'] = "<div class='error'> Не удалось обновить администратора</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-company.php");
        }
    }
?>



<?php include('partials/footer.php'); ?>