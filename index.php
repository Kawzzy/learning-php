<?php 
    require './database/db-connection.php';
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
        <a href="index.php">Home</a>
        <a href="./form/add-fact.php">Add Yours</a>
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