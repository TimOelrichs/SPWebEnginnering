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
            Benutzername:<br>
            <input type="text" name="account">
            <br>
            Passwort:<br>
            <input type="password" name="password">
            <br><br>
            Passwort wiederholen:<br>
            <input type="password" name="passwordRepeat">
            <br><br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
    <?PHP

    if (isset($_POST['account']) && isset($_POST['password']) && isset($_POST['passwordRepeat'])) {
        $account = $_POST['account'];
        $passwd = $_POST['password'];
        $repeated_passwd = $_POST['passwordRepeat'];

        if ($passwd == $repeated_passwd) {
            include "./salter.php";
            $account = salter($account);
            $passwd = salter($passwd);
            $file = '../data/raw_passwd.csv';
            $new_line = $account . ',' . $passwd . "\n";
            if (file_put_contents($file, $new_line, FILE_APPEND | LOCK_EX)) {
                echo "<script>alert('Registered successfully!')</script>";
            }
        } else {
            echo "<script>alert('Passwörter stimmern nicht überein!')</script>";
        }
    }
    ?>

</body>

</html>