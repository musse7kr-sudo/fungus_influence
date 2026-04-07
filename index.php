<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungus Influence</title>
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

            <?php if (isset($_SESSION['username'])): ?>
                <li><span class="user-welcome">Hej, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                <li><a href="logout.php">Logga ut</a></li>
            <?php else: ?>
                <li><a href="login.php">Logga in</a></li>
                <li><a href="register.php">Registrera</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<section class="hero">
    <div class="hero-content">
        <img src="images/logo.jpg" alt="The Last of Us logo" class="hero-logo">

        <p class="hero-text">
            Här finns merch om THE LAST US! Besök Gärna!     </p>

        <a href="merch.php" class="btn">Se merch</a>
    </div>
</section>

<section class="section intro-section">
    <h2>Välkommen</h2>
    <p>
         Här visar vi en mörk design, passande produkter och en stil som ger en mörk framtidskänsla.
    </p>
</section>

<footer>
    <p>
        Detta är en tribute-sida inspirerad av The Last of Us.
    </p>
</footer>

</body>
</html>