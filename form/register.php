<?php

    require '../database/db-connection.php';

    $username = $pass = $confPass = '';

    if (isset($_POST['submit'])) {
        if ($_POST['username'] == null || $_POST['pass'] == null || $_POST['confPass'] == null) {
             echo "Both username, password and confirm password are required!";
        }

        $username = strtolower(htmlspecialchars($_POST['username']));
        $pass = htmlspecialchars($_POST['pass']);
        $confPass = htmlspecialchars($_POST['confPass']);
    }
    
    if (!empty($username) && !empty($pass) && !empty($confPass)) {
        if ($pass === $confPass) {
            try {
                $getUser = "SELECT * FROM user WHERE username = '".$username."'";
                $result = $pdoConn->query($getUser);

                if ($result->rowCount() === 0) {
                    try {
                        $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
                        $createUser = "INSERT INTO user (username, pass_hash) VALUES (:username, :pass_hash)";
                        $stmt = $pdoConn->prepare($createUser);
                        $stmt->execute([
                            'username' => $username,
                            'pass_hash' => $hashedPass
                        ]);

                        header("Location: ../index.php");
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                } else {
                    echo "Username '$username' already exists!";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Passwords does not match!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Create account</title>
</head>

<body>
    <main>
        <form class="signup-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <label for="pass">Password</label>
            <input type="password" name="pass" required>
            <label for="confPass">Confirm password</label>
            <input type="password" name="confPass" required>
            <button type="submit" name="submit">Sign up</button>
        </form>
    </main>
</body>

</html>