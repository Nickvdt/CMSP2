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
    
<?php
if (!isset($_POST['submit'])) {
?>

    <form  class="form__login" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <h2 class="form__login--h2">Aanmeldpagina</h2>
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
            <input class="form__login--submit" type="submit" name="button" value="Aanmelden">
        </div>

        <section class="login__section">
            <p class="login__section--p">Heb je al een account? Klik <a href="login.php">hier</a></p>
        </section>
    <?php
    } else {
    try {
        $db_path = '../Private/db/cms.db';
        $sql = "INSERT INTO users (username, password, user_type) VALUES
        (:username, :password, :user_type)";
        $stmt = $db_path->prepare($sql);

        $username = filter_input(INPUT_POST, 'username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR)

        $password = filter_input(INPUT_POST, 'password');
        $stmt->bindValue(':password', $password, PDO::PARAM_STR)

        $user_type = filter_input(INPUT_POST, 'user_type');
        $stmt->bindValue(':user_type', $user_type, PDO::PARAM_STR)

        $succes = $stmt->execute();
        if($succes){
            echo "Gebruiker is succesvol aangemaakt!";
        } else{
            echo "Er is iets mis gegaan";
        }
        $db = null
        } catch (PDOExeption $e) {
            print "Er is een error: " . $e->getMessage() . "<br/>";
            die();
        }



    }
    ?>
    
    </form>
</body>
</html>