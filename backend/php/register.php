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
            <div id="username">
                Benutzername:</div>
            <input type="text" name="account">
            <div id="pwd">
                Passwort:</div>
            <input type="password" name="password">
            <div id="r_pwd">
                Passwort wiederholen:
            </div>
            <input type="password" name="passwordRepeat">
            <br><br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
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

    <?PHP

    if (isset($_POST['account']) && isset($_POST['password']) && isset($_POST['passwordRepeat'])) {
        $account = $_POST['account'];
        $passwd = $_POST['password'];
        $repeated_passwd = $_POST['passwordRepeat'];

        $file = '../data/raw_passwd.csv';
        include "./users.php";
        echo "<script> errors = {}'</script>";
        if (!userExists($account)) {
            if ($passwd == $repeated_passwd) {
                $account = salter($account);
                $passwd = salter($passwd);
                $new_line = $account . ',' . $passwd . "\n";
                if (file_put_contents($file, $new_line, FILE_APPEND | LOCK_EX)) {
                    echo "<script>alert('Registered successfully!')</script>";
                }
            } else {
                echo "<script> errors['pwd'] = 'Passwörter stimmen nicht überein'</script>";
            }
        } else {
            echo "<script> errors['user'] = 'Benutzername ist bereits vergeben'</script>";
        }
        echo "<script> if(errors){showErrors()}'</script>";
    }
    ?>

</body>

</html>