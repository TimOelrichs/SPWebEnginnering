<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <?PHP

    session_start();

    if (isset($_POST['account']) && isset($_POST['password'])) {
        include "./users.php";
        if (login($_POST)) {
            $_SESSION["login"] = 1;
            header("Location: navigator.php");
            exit;
        }
    }

    if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
        header("Location: navigator.php");
        exit;
    }
    ?>



    <form method="post">
        <fieldset>
            <legend>LogIn:</legend>
            <div id="username">
                Benutzername:</div>
            <input type="text" name="account">
            <div id="pwd">
                Passwort:</div>
            <input type="password" name="password">
            <br><br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
    <a href="register.php">Registrieren</a>
    <script>
        errors = {};

        function showErrors() {
            if (errors.user) {
                document.getElementById("username").innerText += err.user;
            }
            if (errors.pwd) {
                document.getElementById("r_pwd").innerText += err.pwd;
            }
        }
    </script>



</body>

</html>