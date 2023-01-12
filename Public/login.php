<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="body__login">
    <form class="form__login" method="POST" action="">
        <h2 class="form__login--h2">Inlogpagina</h2>
        <div class="form__login--div">
            <label for="username">Gebruikersnaam</label>
            <input class="input__veld" type="text" name="username" id="username" required>
        </div>
        <div class="form__login--div">
            <label for="password">Wachtwoord</label>
            <input class="input__veld" type="password" name="password" id="password" required>
        </div>
        <input class="form__login--submit" type="submit" name="button" value="Inloggen">
    
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Maak verbinding met de SQLite-database
    $db = new SQLite3('../Private/db/cms.db');

    // Controleren of de gebruikersnaam en wachtwoord in de database staan.
    $stmt = $db->prepare('SELECT * FROM users WHERE username=:username AND password=:password');
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        // De gebruiker is ingelogd en gaat naar de homepage.
        session_start();
        $_SESSION['username'] = $username;
        header('location: home.php');
    } else {
        // De gebruiker is niet ingelogd en geeft en error bericht. 
        echo "<div class='error'>Ongeldige gebruikersnaam of wachtwoord</div>";
    }
}
?>
</form>
</body>
</html>