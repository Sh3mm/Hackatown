<?php
/**
 * Controls connection to the website
 * \File : login.php
 */

$require_once('checkConnection.php');

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
        )
    );
    $loginSuccess = false;
    if($data = $req->fetch()){
        $loginSuccess = password_verify($_POST['password'], $data['password']);
    }
    if($loginSuccess){
        // setting sessions variables that verifies connection
        $_SESSION['isConnected'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['accessLevel'];
    }
    else{
        // Wrong password
        require('login.html');
        exit();
    }
}



