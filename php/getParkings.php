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
elseif (isset($_GET['lon']) && isset($_GET['lat']) && !empty($_GET['lon']) && !empty($_GET['lat'])){
    $output = [];
    $scriptPath = "../Getlocation.py";
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];
    // get json from the python script
    exec("python3 $scriptPath " . floatval($lon) . ' ' . floatval($lat), $output);
    // output json
    if($output[0] == true){
        $dataPath = "../data.json";
        echo file_get_contents($dataPath);
    }
    else{
        echo '{"message" : "Something went wrong..."}';
    }
}
else{
    echo '{"message" : "Wrong params"}';
}