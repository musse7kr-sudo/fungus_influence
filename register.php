<?php
include 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Registrering lyckades! Du kan nu logga in.";
            } else {
                $message = "Något gick fel. E-postadressen kanske redan används.";
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
    <title>Registrera - Fungus Influence</title>
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

<section class="section intro-section">
    <h2>Registrera konto</h2>
    <p>Skapa ett konto för att bli en del av Fungus Influence.</p>
</section>

<section class="section contact-wrapper">
    <div class="contact-card">
        <h3>Registrering</h3>

        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Användarnamn" required>
            <input type="email" name="email" placeholder="E-post" required>
            <input type="password" name="password" placeholder="Lösenord" required>
            <button type="submit">Registrera</button>
        </form>
    </div>

    <div class="contact-card">
        <h3>Information</h3>
        <p>Efter registrering kan du logga in på sidan.</p>
        <p>Dina uppgifter sparas i databasen och lösenordet krypteras säkert.</p>
    </div>
</section>

<footer>
    <p>
        Detta är inspirerat av The Last of Us.
    </p>
</footer>

</body>
</html>