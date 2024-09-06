<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Greeting</title>
</head>
<body>
    <header>
        <h1>Greetings!</h1>
    </header>
    <section>
        <?php
            var_dump($_GET);
            $name = $_GET['name'] ?? "Guest";
            $surname = $_GET['surname'] ?? "";

            echo "Hello $name $surname!";
        ?>
    </section>
</body>
</html>