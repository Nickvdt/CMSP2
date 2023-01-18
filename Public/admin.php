<?php
session_start();
if ($_SESSION['user_type'] == 'admin') {
    echo('je bent admin');
} else {
    echo('je bent geen admin');
}
?>