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
            Utforska merch, atmosfär och en värld präglad av överlevnad,
            förfall och svampinfektion.
        </p>

        <a href="merch.php" class="btn">Se merch</a>
    </div>
</section>

<section class="section intro-section">
    <h2>Välkommen</h2>
    <p>
        Fungus Influence är en inofficiell tribute-sida inspirerad av spelet och tv-serien
        The Last of Us. Här visar vi upp mörk design, tematiska produkter och en stil som
        passar den postapokalyptiska känslan.
    </p>
</section>

<footer>
    <p>
        Detta är en inofficiell tribute-sida inspirerad av The Last of Us och är inte kopplad
        till de officiella rättighetsinnehavarna.
    </p>
</footer>

</body>
</html>