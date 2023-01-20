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
    <form  class="form__login" action="" method="post">
        <h2 class="form__login--h2">Inlogpagina</h2>
        <div class="form__login--div">
            <label for="username">Gebruikersnaam</label>
            <input class="input__veld" type="text" name="username" id="username" required>
        </div>
        <div class="form__login--div">
            <label for="password">Wachtwoord</label>
            <input class="input__veld" type="password" name="password" id="password" required>
        </div>
        <label for="user_type">Gebruikerstype:</label>
        <div class="form__login--div">
            <select id="user_type" name="user_type" required>
                <option value="">Selecteer een optie</option>
                <option value="user">Gebruiker</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
            </select>
            <input class="form__login--submit" type="submit" name="button" value="Inloggen">
        </div>

        <section class="login__section">
            <p class="login__section--p">Heb je al een account? Klik <a href="login.php">hier</a></p>
        </section>
    </form>
    <?php
     if (isset($_POST['submit'])) {
            require_once('../Private/init.php');
            require_once('../Private/database.php');

            $username = $_POST['username'];
           $password = $_POST['password'];
           $user_type = $_POST['user_type'];

           $query = "INSERT INTO users (username, password, user_type) VALUES (?,?,?)";
           $stmt = $db->prepare($query);
           $stmt->execute([$username, $password, $user_type]);

            if ($stmt->rowCount() > 0) {
             echo "Gebruiker is succesvol toegevoegd";
         } else {
                echo "Er is iets misgegaan tijdens het toevoegen van de gebruiker";
            }
        }
        ?>
</body>
</html>