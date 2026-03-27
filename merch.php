<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merch</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <h1>FUNGUS INFLUENCE</h1>
        <ul>
            <li><a href="index.php">Hem</a></li>
            <li><a href="about.php">Om</a></li>
            <li><a href="merch.php">Merch</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <li><a href="login.php">Logga in</a></li>
            <li><a href="register.php">Registrera</a></li>
        </ul>
    </nav>
</header>

<section class="section">
    <h2>Vår merch</h2>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'>";
                echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<strong>" . htmlspecialchars($row['price']) . " kr</strong>";
                echo "</div>";
            }
        } else {
            echo "<p>Inga produkter hittades ännu.</p>";
        }
        ?>
    </div>
</section>

<footer>
    <p>Detta är en inofficiell tribute-sida inspirerad av The Last of Us.</p>
</footer>

</body>
</html>