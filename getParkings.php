<?php
/**
 * Created by PhpStorm.
 * User: MagicHack
 * Date: 2018-01-20
 * Time: 22:23
 */

require_once ('config.php');
require_once ('checkConnection.php');


if(!$_SESSION['isConnected']){
    echo '{"message" : "Not connected"}';
}
elseif (isset($_POST['lon']) && isset($_POST['lat']) && !empty($_POST['lon']) && !empty($_POST['lat'])){
    $output = [];
    $scriptPath = "Getlocation.py";
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];
    // get json from the python script
    exec("python3 $scriptPath " . floatval($lon) . ' ' . floatval($lat), $output);
    // output json
    foreach ($output as $item) {
        echo $item;
    }
}
else{
    echo '{"message" : "Wrong params"}';
}