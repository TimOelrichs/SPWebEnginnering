<?PHP
session_start();

if (isset($_POST['account']) && isset($_POST['password']) && isset($_POST['passwordRepeat'])) {
    $account = $_POST['account'];
    $passwd = $_POST['password'];
    $repeated_passwd = $_POST['passwordRepeat'];

    $file = '../common/data/users.csv';
    include "../common/util/users.php";
    echo "<script> var errors = {};</script>";
    if (!userExists($_POST)) {
        if ($passwd == $repeated_passwd) {
            $account = salter($account);
            $passwd = salter($passwd);
            $new_line = $account . ',' . $passwd . "\n";
            if (file_put_contents($file, $new_line, FILE_APPEND | LOCK_EX)) {
                $_SESSION["login"] = 1;
                $_SESSION["user"] = $_POST['account'];
                header("Location: success.php");
                exit;
            }
        } else {
            echo "<script>errors['pwd'] = 'Passwörter stimmen nicht überein'</script>";
        }
    } else {
        echo "<script> errors['user'] = 'Benutzername ist bereits vergeben'</script>";
    }
    echo "<script> if(errors){showErrors()}'</script>";
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Registrieren:</h1>
        </div>
        <form method="post">
            <fieldset>
                <div>
                    Benutzername:</div>
                <input type="text" name="account">
                <div>
                    Passwort:</div>
                <input type="password" name="password">
                <div>
                    Passwort wiederholen:
                </div>
                <input type="password" name="passwordRepeat">
                <br><br>
                <div id="errors"></div>
                <input type="submit" value="Submit">
                <br>
            </fieldset>

        </form>
        <script>
            window.onload = showErrors();

            function showErrors() {
                if (errors) {
                    let div = document.getElementById("errors");
                    if (errors.user) {
                        div.innerText += errors.user + "\n";
                    }
                    if (errors.pwd) {
                        div.innerText += errors.pwd;
                    }
                }
            }
        </script>

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
        </style>

</body>

</html>