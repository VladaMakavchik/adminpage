<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Обновить Заказ</h1>

        <br> <br>

        <?php
            // получение id выбранного админа
            $id=$_GET["id"];

            //sql запрос на получение деталей
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //доступны ли данные или нет
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //получаем информацию
                    // echo "Админ доступен";
                    $row=mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $custumer_name = $row['custumer_name'];
                    $company = $row['company'];
                    $status = $row['status'];
                }
                else
                {
                    // перевод на менедж админ
                    header("location: http://localhost:8888/admin/manage-order.php");
                }

            }
            // else
            // {

            // }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Блюдо:</td>
                    <td>
                        <input type="text" name="food" value="<?php echo $food; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Цена:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Количество:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Имя заказчика:</td>
                    <td>
                        <input type="text" name="custumer_name" value="<?php echo $custumer_name; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Компания:</td>
                    <td>
                        <input type="text" name="company" value="<?php echo $company; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Статус:</td>
                    <td>
                        <input <?php //if($status=='Заказан')(echo "selected";) ?> type="radio" name="status" value="Заказан"> Заказан
                        <input <?php //if($status=='Доставлен')(echo "selected";) ?> type="radio" name="status" value="Доставлен"> Доставлен
                        <!-- <input type="text" name="company" value="<?php //echo $company; ?>"></input> -->
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Обновить заказ" class="btn btn-primary">
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
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $custumer_name = $_POST['custumer_name'];
        $company = $_POST['company'];
        $status = $_POST['status'];

        $sql = "UPDATE tbl_order SET
            food = '$food',
            price = '$price',
            qty = '$qty',
            custumer_name = '$custumer_name',
            company = '$company',
            status = '$status'
            WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //обновлен
            $_SESSION['update'] = "<div class='success'> Администратор обновлен</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-order.php");
        }
        else
        {
            //не удалось
            $_SESSION['update'] = "<div class='error'> Не удалось обновить администратора</div>";
            //перевод на стр
            header("location: http://localhost:8888/admin/manage-order.php");
        }
    }
?>



<?php include('partials/footer.php'); ?>