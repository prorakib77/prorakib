<?php
session_start();
$db_connect = mysqli_connect('localhost', 'root', '', 'twenty_one');


if (isset($_POST['name_change_btn'])) {
    $name = $_POST['profile_name'];
    $id = $_SESSION['s_id'];
    $name_change_query = "UPDATE users SET name = '$name' WHERE id = '$id';";
    mysqli_query($db_connect, $name_change_query);
    $_SESSION['s_name'] = $name;
    header('location: profile.php');
}
if (isset($_POST['email_change_btn'])) {
    $email = $_POST['profile_email'];
    $id = $_SESSION['s_id'];
    $email_change_query = "UPDATE users SET email = '$email' WHERE id = '$id';";
    mysqli_query($db_connect, $email_change_query);
    $_SESSION['s_email'] = $email;
    header('location: profile.php');
}




if (isset($_POST['profile_change_btn'])) {
    $id = $_SESSION['s_id'];
    $profile_photo_name = $_FILES['profile_photo']['name'];
    $after_exployed = explode('.', $profile_photo_name);
    $extention = end($after_exployed);
    $new_name = $id . "." . $extention;
    $old_location = $_FILES['profile_photo']['tmp_name'];
    $new_location = ("uploads/profile_photo/" . $new_name);
    move_uploaded_file($old_location, $new_location);
    $profile_photo_update_query = "UPDATE users SET profile_photos = '$new_name' WHERE id = '$id'";
    mysqli_query($db_connect, $profile_photo_update_query);
    header('location: profile.php');
}



if (isset($_POST['password_change_btn'])) {
    $id = $_SESSION['s_id'];
    $old_pass = $_POST['old_password'];
    $encript_pass = md5($old_pass);
    $old_match_pass = $_SESSION['old_password'];
    $password = md5($_POST['login_password']);

    $pass_query = "SELECT password FROM users WHERE id='$id' AND password='$encript_pass'";

    $final_pass_slesction = mysqli_query($db_connect, $pass_query);
    // $after_pass_assoc = mysqli_fetch_assoc($final_pass_slesction)['result'];
    if (isset($encript_pass)) {
        if (mysqli_num_rows($final_pass_slesction) === 1) {
            $new_pass = $_POST['new_password'];
            $new_con_pass = $_POST['confirmm_password'];
        
            if ($new_pass != $new_con_pass) {
                $enc_new_pass = md5($new_pass);
                $pass_update_query = "UPDATE users SET password = '$enc_new_pass' WHERE id = '$id';";
                mysqli_query($db_connect, $pass_update_query);
                header('location: profile.php?success=Your password has been changed successfully');
            } else {
                $_SESSION['pass_change_match_error'] = "New password and Confirm Does Not Matched";
                header('location: profile.php');
            }
        } else {
            $_SESSION['pass_change_error'] = "Old Password Does Not Matched";
            header('location: profile.php');
        }
    }


    print_r($_POST);
}



// SELECT password FROM users WHERE id = '6'

// Array ( [profile_photo] => Array ( [name] => kawsar-12.jpg [full_path] => kawsar-12.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\phpA3DE.tmp [error] => 0 [size] => 7033 ) ) 


// if ($encript_pass === 1 $after_pass_assoc) {
//     $new_pass = $_POST['new_password'];
//     $new_con_pass = $_POST['confirmm_password'];

//     if ($new_pass != $new_con_pass) {
//         $enc_new_pass = md5($new_pass);
//         $pass_update_query = "UPDATE users SET password = '$enc_new_pass' WHERE id = '$id';";
//         mysqli_query($db_connect, $pass_update_query);
//         header('location: profile.php');
//     } else {
//         $_SESSION['pass_change_match_error'] = "New password and Confirm Does Not Matched";
//         header('location: profile.php');
//     }
// } else {
//     $_SESSION['pass_change_error'] = "Old Password Does Not Matched";
//     header('location: profile.php');
// }