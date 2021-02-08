<?PHP

session_start();

if (isset($_POST['account']) && isset($_POST['password'])) {
    include "../common/util/users.php";
    if (login($_POST)) {
        $_SESSION["login"] = 1;
        $_SESSION["user"] = $_POST['account'];
        header("Location: navigator.php");
        exit;
    }
}

if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    header("Location: navigator.php");
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
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    html {
        height: 100%;
        width: 100%;
    }

    h1 a {
        text-decoration: none;
        color: white;
    }

    body {
        width: 100%;
        height: 100%;
        display: grid;
        grid-template-rows: auto 1fr auto;
    }

    header,
    footer {
        background-color: #333;
        color: white;
        padding: 5px 30px;
    }

    main {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-content: flex-start;
    }

    fieldset {

        height: 300px;
        border: 0px;
    }

    fieldset {
        width: 200px;
        height: 200px;
        border: 0px;
    }

    form {
        margin-top: 50px;
        width: 200px;
        border: 1px solid grey;
    }

    form h4 {

        background-color: #333;
        color: white;
        width: 200px;
        padding: 5px 15px;

    }
</style>

<body>

    <header>
        <h1> <a href="./navigator.php">PHP WWW-Navigator</a></h1>
    </header>
    <main>

        <form method="post">

            <h4>Login:</h4>

            <fieldset>

                <div id="username">
                    Benutzername:</div>
                <input type="text" name="account">
                <div id="pwd">
                    Passwort:</div>
                <input type="password" name="password">
                <br><br>
                <input type="submit" value="Submit">
            </fieldset>
            <a href="register.php">Registrieren</a>
        </form>
    </main>
    <footer>

    </footer>
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