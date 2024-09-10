<?php 
    
    require '../database/db-connection.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['id'])) {
        header("Location: register.php");
        exit();
    }

    $title = $fact = '';
    
    if (isset($_POST['submit'])) {
        if ($_POST['title'] == null || $_POST['fact'] == null) {
            echo "Both title and fact are required!";
        }
        
        $title = htmlspecialchars($_POST['title']);
        $fact = htmlspecialchars($_POST['fact']);

    }
    
    if (!empty($title) && !empty($fact)) {
        try {
            $addFact = "INSERT INTO fact (title, fact) VALUES (:title, :fact)";
            $stmt = $pdoConn->prepare($addFact);
            $stmt->execute([
                'title' => $title,
                'fact' => $fact
            ]);

            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Funny Facts</title>
</head>

<body>

    <header>
        <h1>Funny Facts</h1>
    </header>

    <nav>
        <a href="../index.php">Home</a>
        <a href="add-fact.php">Add Yours</a>
    </nav>

    <main>
        <h2>Add Your Funny Fact</h2>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="title" placeholder="Give your funny fact a title" required>
            <textarea name="fact" rows="4" placeholder="Share a funny fact about you" maxlength="255" required></textarea>

            <button type="submit" name="submit">Submit</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Funny Facts. All rights reserved.</p>
    </footer>

</body>

</html>