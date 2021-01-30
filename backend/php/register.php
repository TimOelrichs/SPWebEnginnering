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
            <legend>Register a new Account:</legend>
            Account name:<br>
            <input type="text" name="account">
            <br>
            Password:<br>
            <input type="password" name="password">
            <br><br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
    <?PHP
    if (isset($_POST['account']) && isset($_POST['password'])) {
        $account = $_POST['account'];
        $passwd = $_POST['password'];
        $file = '../data/raw_passwd.csv';
        $new_line = $account . ',' . $passwd . "\n";
        if (file_put_contents($file, $new_line, FILE_APPEND | LOCK_EX)) {
            echo "<script>alert('Registered successfully!')</script>";
        }
    }
    ?>

</body>

</html>