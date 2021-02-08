<?PHP

session_start();

if (isset($_POST['account']) && isset($_POST['password'])) {
    include "../common/util/users.php";

    if (login($_POST)) {
        $_SESSION["login"] = 1;
        $_SESSION["user"] = $_POST['account'];
        header("Location: success.php");
        exit;
    } else {
        echo '<script> errors = "Login fehlgeschlagen! Bitte versuchen Sie es erneute" </script>';
    };
}

if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    header("Location: success.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    html,
    body {
        width: 100%;
        height: 100%;
        font-family: Arial, Helvetica, sans-serif;
    }

    h1 {
        color: white;
        padding: 5px;
    }

    body {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .container {
        margin-top: 30px;
        width: 30vw;
        height: 300px;
        min-width: 300px;
        border: 1px solid lightgray;
        border-radius: 5px;
    }

    .header {
        padding: 5px 30px;
        width: 100%;
        background-color: deepskyblue;
    }

    fieldset {
        padding: 5px 30px;
        border: 0px;
        text-align: center;
    }

    input[type=text],
    input[type=password],
    input[type=submit] {
        width: 150px;
        height: 30px;
        padding: 5px 15px;
        border-radius: 5px;
    }

    input[type=submit] {
        font-weight: bold;
        color: white;
        background-color: deepskyblue;
    }

    fieldset a {
        margin-top: 20px;
    }

    #id {
        height: 15px;
        margin: 15px;
    }
</style>

<body>

    <div class="container">
        <div class="header">
            <h1>Login:</h1>
        </div>
        <form method="post">
            <fieldset>
                <div id="username">
                    Benutzername:</div>
                <input type="text" name="account">
                <div id="pwd">
                    Passwort:</div>
                <input type="password" name="password">
                <br><br>
                <input type="submit" value="Submit">
                <div id="msg"></div>
                <a href="register.php">Registrieren</a>
            </fieldset>

        </form>

    </div>
    <script>
        window.onload = () => {

            if (errors) document.getElementById("msg").innerText = errors;
        }
    </script>



</body>

</html>