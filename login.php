<?php
session_start();
include 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($user = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $user['username'];
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "Fel lösenord.";
                }
            } else {
                $message = "Ingen användare hittades med den e-posten.";
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
    <title>Logga in - Fungus Influence</title>
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
    <h2>Logga in</h2>
    <p>Logga in med ditt konto för att fortsätta.</p>
</section>

<section class="section contact-wrapper">
    <div class="contact-card">
        <h3>Inloggning</h3>

        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="email" name="email" placeholder="E-post" required>
            <input type="password" name="password" placeholder="Lösenord" required>
            <button type="submit">Logga in</button>
        </form>
    </div>

    <div class="contact-card">
        <h3>Information</h3>
        <p>Om du redan har registrerat dig kan du logga in här.</p>
        <p>Om du inte har ett konto ännu, gå till registreringssidan först.</p>
    </div>
</section>

<footer>
    <p>
        Detta är inspirerat av The Last of Us.
    </p>
</footer>

</body>
</html>