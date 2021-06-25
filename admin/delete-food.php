<?php

    include('../config/constants.php');
    
    //получим id администратора, которого хотим изменить
    $id = $_GET['id'];

    // sql запрос для удаления
    $sql = "DELETE FROM tbl_food WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        //обновлено успешно. админ удален
        $_SESSION['delete'] = "Блюдо удалено";
        header("location: http://localhost:8888/admin/manage-food.php");
    }
    else
    {
        //не удалось удалить администратора
        $_SESSION['delete'] = "Не удалось удалить блюдо";
        header("location: http://localhost:8888/admin/manage-food.php");
    }

?>