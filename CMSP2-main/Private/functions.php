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

function admin_check() {
    if (!isset($_SESSION['admin'])) {
        header('location: admin.php');
        exit;

    }
}

function show_admin_link() {
    if ($_SESSION['user_type'] === 'admin') {
        echo '<a href="admin.php">Admin Dashboard</a>';
    }
}



function get_all_users(){
    global $db;
    $stmt = $db->prepare('SELECT * FROM users');
    $result = $stmt->execute();
    $users = array();
    while($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $users[] = $row;
    }
    return $users;
}


?>