<?php
/**
 * Controls connection to the website
 * \File : login.php
 */
require_once ('config.php');
require_once('checkConnection.php');
$errors = [];
if($_SESSION['isConnected']){
    header('Location: index.html');
    exit();
}
// Put in a function??
elseif(isset($_POST['username']) && isset($_POST['password']) AND !empty($_POST['username']) && !empty($_POST['password'])){
    require_once ('db.php');

    $req = $db->prepare('SELECT * FROM users WHERE username = :username');
    $req->execute(array(
        'username' => $_POST['username']
        ));
    $loginSuccess = false;
    if($data = $req->fetch()){
        echo password_verify($_POST['password'], $data['password']);
        echo "resultat: ".$loginSuccess;
    }
    if($loginSuccess){
        if($data['accessLevel'] >= $ACTIVATION_LEVEL) {
            // setting sessions variables that verifies connection
            $_SESSION['isConnected'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['level'] = $data['accessLevel'];
            header('Location: index.html');
        }
        else{
            $errors[] = "Your account is not currently activated";
        }
    }
    else{
        // Wrong password
        $errors[] = "Wrong username or password";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<form method="post" action="login.php">
    <label for="user">Username : </label><input type = "text" name="username" id="user"> <br>
    <label for="pw">Password : </label><input type = "password" name = "password" id="pw"><br>
    <input type="submit" value="register">
</form>
<?php
require ('errors.php');
?>

</body>
</html>




