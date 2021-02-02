<?PHP
session_start();

if (isset($_POST['account']) && isset($_POST['password']) && isset($_POST['passwordRepeat'])) {
    $account = $_POST['account'];
    $passwd = $_POST['password'];
    $repeated_passwd = $_POST['passwordRepeat'];

    $file = './data/users.csv';
    include "./helpers/users.php";
    echo "<script> var errors = {};</script>";
    if (!userExists($_POST)) {
        if ($passwd == $repeated_passwd) {
            $account = salter($account);
            $passwd = salter($passwd);
            $new_line = $account . ',' . $passwd . "\n";
            if (file_put_contents($file, $new_line, FILE_APPEND | LOCK_EX)) {
                $_SESSION["login"] = 1;
                $_SESSION["user"] = $_POST['account'];
                header("Location: navigator.php");
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
    <form method="post">
        <fieldset>
            <legend>Neuen Account erstellen:</legend>
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
        </fieldset>
        <a href="login.php">einloggen</a>
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

</body>

</html>