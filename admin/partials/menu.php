<?php 
    include('../config/constants.php');
    include('login-check.php'); 
?>

<html>
    <head>
        <meta charset="utf-8">
        <title> Администратор </title>
        <link rel = "stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!-- меню секшн -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="manage-admin.php">Администратор</a></li>
                    <li><a href="manage-category.php">Категории</a></li>
                    <li><a href="manage-food.php">Меню</a></li>
                    <li><a href="manage-company.php">Компании</a></li>
                    <li><a href="manage-order.php">Заказы</a></li>
                    <li><a href="logout-admin.php">Выйти</a></li>
                </ul>
            </div>
        </div>