<?php
require './database/db-connection.php';

if (!isset($_SESSION)) {
    session_start();
}

$getAllFacts = "SELECT * FROM fact";

$facts = $pdoConn->query($getAllFacts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Funny Facts</title>
</head>

<body>

    <header>
        <h1>Funny Facts</h1>
    </header>

    <nav>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="./form/add-fact.php">Add Yours</a>
        </div>
        <div class="user-info">
            <?php if (isset($_SESSION['id'])) : ?>
                <p>
                    Welcome <strong><?= ucfirst($_SESSION['username']) ?></strong>!
                </p>
                <a href="./form/logout.php">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <section>
            <div class="greeting">
                <h2>Welcome to Funny Facts!</h2>
                <p>Here, you'll find some hilarious and interesting facts of people from all around the world.</p>
            </div>
            <div class="facts">
                <?php foreach ($facts as $fact): ?>
                    <div class="fact">
                        <p class="fact-title">
                            <?= $fact->title ?>
                        </p>
                        <p class="fact-content">
                            <?= $fact->fact ?>
                        </p>
                        <small class="created_at">
                            <?= date('m/d/Y', (int) $fact->created_at) ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Funny Facts. All rights reserved.</p>
    </footer>

</body>

</html>