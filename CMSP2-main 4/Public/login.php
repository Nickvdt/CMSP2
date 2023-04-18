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
<?php
require_once('../Private/init.php');
require_once('../Private/functions.php');
require_once('../Private/database.php');

abstract class User {
    private $username;
    private $password;
    private $user_type;

    public function __construct($username, $password, $user_type) {
        $this->username = $username;
        $this->password = $password;
        $this->user_type = $user_type;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUserType() {
        return $this->user_type;
    }

    abstract public function getHomePage();

    public function login() {
        global $db;

        $user = get_user($this->username, $this->password, $this->user_type);
        if ($user) {
            login_user($this->username, $this->user_type);
            header('location: ' . $this->getHomePage());
            exit;
        } else {
            echo '<script type="text/javascript">window.onload = function () { alert("Ongeldige gebruikersnaam, wachtwoord of gebruikerstype"); } </script>';
        }
    }
}

class Admin extends User {
    public function getHomePage() {
        return 'admin.php';
    }
}

class Editor extends User {
    public function getHomePage() {
        return 'editor.php';
    }
}

class RegularUser extends User {
    public function getHomePage() {
        return 'home.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    switch ($user_type) {
        case 'admin':
            $user = new Admin($username, $password, $user_type);
            break;
        case 'editor':
            $user = new Editor($username, $password, $user_type);
            break;
        case 'user':
        default:
            $user = new RegularUser($username, $password, $user_type);
            break;
    }

    $user->login();
}
?>

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
        <p class="login__section--p">Geen account? klik <a href="aanmelden.php">hier</a></p>
    </section>
</form>
</body

