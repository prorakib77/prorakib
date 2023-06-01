<?php 
session_start();
$name = $_POST['name_error'];
$email = $_POST['email_error'];
$password = $_POST['password_error'];
$confirm_password = $_POST['confirm_password_error'];
$flag = false;
$preg_maa = preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password);


if ($name) {
    $_SESSION['old_name'] = "$name";
}
else{
    $_SESSION['name_error'] = "Name is missing";
    $flag = true;
}
if ($email) {
    $_SESSION['old_email'] = "$email";
}
else{
    $_SESSION['email_error'] = "Email is missing";
    $flag = true;
}
if ($password) {
    $_SESSION['old_password'] = "$password";
}
else{
    $_SESSION['password_error'] = "Password is missing";
    $flag = true;
}
// if (strlen($password < 8)) {
//     echo "Yoyr pas $password";
// }
// else{
//     $_SESSION['password_len_error'] = "Password must be minimum 8 characters length*";
// }
if ($confirm_password) {
    // $_SESSION['old_confirm_password'] = "$password";
}
else{
    $_SESSION['confirm_password_error'] = "Confirm Password is missing";
    $flag = true;
}
if ($password != $confirm_password) {
    $flag = true;
    $_SESSION['confirm_password_match_error'] = "Password and Confirm Password is Not Matched";
}
else{
    if ($preg_maa !=1) {
        $flag = true;
        $_SESSION['password_pregma_matching']= "Password must be minimum 8 characters length*";
    }
}

if ($flag== 1) {
    header('location: signup.php');
}
else{
    $encrepted_pass = md5($password);
    $db_connect = mysqli_connect('localhost', 'root', '', 'twenty_one');

    $query_email_validity = "SELECT COUNT(*) AS 'validity' FROM users WHERE email= '$email';";
    $final_validity_slesction = mysqli_query($db_connect, $query_email_validity);
    $after_s_assoc = mysqli_fetch_assoc($final_validity_slesction)['validity'];

    if ($after_s_assoc==1) {
        $_SESSION['email_matching_error'] = "$email is already Exists.";
        header('location: signup.php');
    }
    else{
        $query_insertt = "INSERT INTO users(name,email,password) VALUES('$name','$email','$encrepted_pass')";
        mysqli_query($db_connect, $query_insertt);
        $_SESSION['login_success']= "Mr./Ms. $name You have successfully login to Naptune";
        header('location: login.php');
    }


}
?>

