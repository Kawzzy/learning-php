<?php 
    
    require('../database/db-connection.php');

    $username = $pass = '';

    if (isset($_POST['submit'])) {
        if ($_POST['username'] == null || $_POST['pass'] == null) {
            echo "Both username and password are required!";
        }

        $username = strtolower(htmlspecialchars($_POST['username']));
        $pass = htmlspecialchars($_POST['pass']);
    }

    if (!empty($username) && !empty($pass)) {
        try {
            $getUser = "SELECT * FROM user WHERE username = '" . $username . "'";
            $stmt = $pdoConn->query($getUser);
            $result = $stmt->fetchAll();

            if ($stmt->rowCount() === 0) {
                echo "User '$username' not found!";
            } else {
                $dbPass = $result[0]->pass_hash;

                if (password_verify($pass, $dbPass)) {
                    session_start();
                    $_SESSION['id'] = $result[0]->id;
                    $_SESSION['username'] = $result[0]->username;

                    header("Location: ../index.php");
                    exit();
                } else {
                    echo "Wrong credentials! Try again.";
                //     header("Location: register.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>