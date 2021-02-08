<?php

session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="site">
        <header><a class="btn" href="logout.php">Log Out</a></header>
        <main><?php
                echo "<h1>Hallo," . ucwords($_SESSION['user']) . "!</h1>";
                echo "<h2>Du bist nun eingeloggt.</h2>";
                ?>
        </main>
        <style>
            * {
                margin: 0px;
                padding: 0px;
            }

            html,
            body {
                height: 100%;
                width: 100%;
            }

            header {
                padding: 5px 30px;
                background-color: deepskyblue;
                color: white;
                width: 100%;
                height: 50px;
                display: flex;
                justify-content: flex-end;
            }

            header a {
                text-decoration: none;
                text-align: center;
                padding: 0px 30px;
                display: inline-block;
                border-radius: 5px;
                border: 1px solid grey;
                background-color: white;
                color: deepskyblue;
                width: 75px;
                height: 30px;
                margin-right: 50px;
            }

            header a:hover {
                font-weight: bold;
            }

            main {
                width: 100%;
                text-align: center;
            }
        </style>
</body>


</html>