<?php
session_start();
$email = $_POST['login_email'];
$password = md5($_POST['login_password']);

// Database connect 
$db_connect = mysqli_connect('localhost', 'root', '', 'twenty_one');
// query connect 
$count_query = "SELECT COUNT(*) AS 'result' FROM users WHERE email='$email' AND password='$password'";

$final_slesction = mysqli_query($db_connect, $count_query);
$after_assoc = mysqli_fetch_assoc($final_slesction)['result'];
// $flag = false;

if ($email) {
    $_SESSION['old_email'] = "$email";
    if ($password) {
        $_SESSION['old_password'] = "$email";
        if ($after_assoc == 1) {
            header('location: backend/dashbord.php');
                        
            $_SESSION['s_email'] = $email;
            $select_s_query = "SELECT id, name FROM users WHERE email= '$email'";
            $final_s_slesction = mysqli_query($db_connect, $select_s_query);
            $after_s_assoc = mysqli_fetch_assoc($final_s_slesction);
            $_SESSION['s_id'] = $after_s_assoc['id'];
            $_SESSION['s_name'] = $after_s_assoc['name'];
        } else {
            $_SESSION['login_success_error'] = "This email and password is not exist please sign-up a new account.";
            header('location: login.php');
        }
    } else {
        $_SESSION['login_password'] = "Password is missing";
    }
} else {
    $_SESSION['login_email'] = "Email is missing";
}
