<?php
session_start();
include 'db.php';

$message = "";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $image = trim($_POST['image']);

    if (!empty($name) && !empty($description) && !empty($price) && !empty($image)) {
        $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssds", $name, $description, $price, $image);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Produkten lades till!";
            } else {
                $message = "Något gick fel när produkten skulle sparas.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Kunde inte förbereda frågan.";
        }
    } else {
        $message = "Alla fält måste fyllas i.";
    }
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lägg till produkt</title>
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
            <li><span class="user-welcome">Hej, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
            <li><a href="logout.php">Logga ut</a></li>
        </ul>
    </nav>
</header>

<section class="section intro-section">
    <h2>Lägg till produkt</h2>
    <p>Här kan du lägga till nya produkter till merch-sidan.</p>
</section>

<section class="section contact-wrapper">
    <div class="contact-card">
        <h3>Ny produkt</h3>

        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="name" placeholder="Produktnamn" required>
            <textarea name="description" rows="5" placeholder="Beskrivning" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Pris" required>
            <input type="text" name="image" placeholder="Bildfil, t.ex. hoodie.jpg" required>
            <button type="submit">Lägg till produkt</button>
        </form>
    </div>

    <div class="contact-card">
        <h3>Tips</h3>
        <p>Skriv exakt bildfilens namn som finns i mappen <strong>images</strong>.</p>
        <p>Exempel: <strong>newhoodie.jpg</strong></p>
        <p>Produkten visas sedan automatiskt på merch-sidan.</p>
    </div>
</section>

<footer>
    <p>
        Detta är en inofficiell tribute-sida inspirerad av The Last of Us och är inte kopplad
        till de officiella rättighetsinnehavarna.
    </p>
</footer>

</body>
</html>