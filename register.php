<?php
/**
 * To create new accounts for the website
 * \File : register.php
 */
require_once ('config.php');
require_once ('checkConnection.php');
$errors = [];
if($_SESSION['isConnected']){
    header('Location: index.html');
    exit();
}
elseif (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['passwordConf'])){
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['passwordConf'])){
        if($_POST['password'] != $_POST['passwordConf']){
            $errors[] = "Passwords must match";
        }
        if(strlen($_POST['password']) < $MIN_PASS_LEN ){
            $errors[] = "The password must be " . $MIN_PASS_LEN . " characters or more.";
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = "Invalid email";
        }
        // TODO : Add check for username availability
    }
    if(empty($errors)){
        // Can create account
        require_once ('db.php');

        $req = $db->prepare('INSERT INTO users(username, password, email, accessLevel, dateCreated) VALUES(:username, :hashedPass, :email , :access, NOW())');
        $req->execute(array(
            'username' => $_POST['username'],
            'hashedPass' => password_hash($_POST['username'], PASSWORD_DEFAULT),
            'email' => $_POST['email'],
            'access' => $DEFAULT_LEVEL
        ));
        // TODO : add error checking to account creation
        // account created, redirect
        header('Location: login.php');
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title>Register</title>
</head>
<body>
<form method="post" action="register.php">
    <label for="user">Username : </label><input type = "text" name="username" id="user"> <br>
    <label for="email">Email : </label><input type = "text" name="email" id="email"> <br>
    <label for="pw">Password : </label><input type = "password" name = "password" id="pw"><br>
    <label for="pw2">Confirm password : </label><input type = "password" name = "passwordConf" id="pw2"><br>
    <input type="submit" value="register">
</form>
<?php
require ('errors.php');
?>

</body>
</html>