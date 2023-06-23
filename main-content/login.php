<?php
session_start();
$error_msg = '';
$error_msg2 = '';
include 'database_configuration.php';

if(isset($_SESSION['user_details'])){
    header('location:after-login.php');
}
if ( $_POST ) {
    $user_name = $_REQUEST[ 'user-name' ];
    $password = $_REQUEST[ 'password' ];
    $login_check = "select *  from user_details where `user_name`='$user_name'";
    $result = mysqli_query( $conn, $login_check );
    $check = mysqli_num_rows( $result );
    if ( $check>0 ) {
        $row = mysqli_fetch_assoc( $result );
        $pass = $row[ 'password' ];
        $password_validated = password_verify( $password, $pass );
        if ( $password_validated == true ) {
            if ( $row[ 'is_admin' ] == 1 ) {
                $_SESSION[ 'admin_details' ] = $row;
                header( 'location:admin-main.php' );
            } else {
                $_SESSION[ 'user_details' ] = $row;
                header( 'location:after-login.php' );
            }

        } else {
            $error_msg2 = 'Invalid Password';
        }
    } else {
        $error_msg = "User Name doesn't exist";
    }

}
mysqli_close( $conn );
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <link rel='stylesheet' href='../CSS/login-style.css' />
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../Script/loginValidation.js"></script>
    <title>Login to Park Smart</title>
</head>

<body>
    <div id='login'>
        <h1>Login Form</h1>
        <form method='POST' action='' id="loginForm" onsubmit="event.preventDefault();validation();">
            <div class='container'>
                <label for='user-name'>Username</label>
                <input type='text' placeholder='&#xf007; Enter Username' name="user-name" id="user-name">
                <span class="error-message" id="username-validation"></span>
                <span class='backend-error-message'>
                    <?=$error_msg?>
                </span>
                <label for='password'>Password</label>
                <input type='password' placeholder='&#xf084; Enter Password' name='password' id="password">
                <span  class="error-message" id="password-validation"></span>
                <span class='backend-error-message'>
                    <?=$error_msg2?>
                </span>
                <button type='submit'>Login</button>
                <hr>
                <span style="text-align:center"><b>Don't have an account</b></span>
                <a href="registration.php"><button type="button">Create an account</button></a>
            </div>
        </form>
    </div>
</body>

</html>