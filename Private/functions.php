<?php

function is_logged_in(){
    return isset($_SESSION['username']);
}

function get_user($username, $password, $user_type){
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE username=:username AND password=:password AND user_type=:user_type');
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':user_type', $user_type);
    $result = $stmt->execute();
    return $result->fetchArray();
}

function login_user($username, $user_type){
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = $user_type;
}

function check_login() {
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
        exit;
    }
}


?>