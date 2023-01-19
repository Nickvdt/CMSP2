<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanmelden</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="body__login">
    <form class="form__login" method="POST" action="">
        <h2 class="form__login--h2">Aanmeldpagina</h2>
        <div class="form__login--div">
            <label for="username">Voornaam</label>
            <input class="input__veld" type="text" name="username" id="username" required>
        </div>
        <div class="form__login--div">
            <label for="username">Achternaam</label>
            <input class="input__veld" type="text" name="username" id="username" required>
        </div>
        <div class="form__login--div">
            <label for="username">E-mail</label>
            <input class="input__veld" type="text" name="username" id="username" required>
        </div>
        <div class="form__login--div">
            <label for="username">Gebruikersnaam</label>
            <input class="input__veld" type="text" name="username" id="username" required>
        </div>
        <div class="form__login--div">
            <label for="password">Wachtwoord</label>
            <input class="input__veld" type="password" name="password" id="password" required>
        </div>
        
        <div class="form__login--div">
            <input class="form__login--submit" type="submit" name="button" value="Inloggen">
        </div>

        <section class="login__section">
            <p class="login__section--p">Heb je al een account? Klik <a href="login.php">hier</a></p>
        </section>
    
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    $db = new SQLite3('../Private/db/cms.db');

    $stmt = $db->prepare('SELECT * FROM users WHERE username=:username AND password=:password AND user_type=:user_type');
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':user_type', $user_type);
    $result = $stmt->execute();
    $user = $result->fetchArray();
    
    if($user){
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;
        switch($user_type){
            case 'admin':
                header('location: admin.php');
                break;
            case 'editor':
                header('location: editor.php');
                break;
            case 'user':
                header('location: home.php');
                break;
        }
    } else {
        echo "<div class='error'>Ongeldige gebruikersnaam, wachtwoord of gebruikerstype</div>";
    }
}
?>
</form>
</body>
</html>