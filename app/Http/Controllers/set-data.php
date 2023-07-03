<?php
require_once('config.php');

function sendPostRequest($servo_state) {
    $url = 'https://platform.antares.id:8443/~/antares-cse/antares-id/Digital-Twin/LoRa';

    $data = array(
        'm2m:cin' => array(
            'con' => '{"device":{"modelMotor":"Motor Diesel 4 langkah horizontal","jumlahSilinder":"1","dimensi":"672 x 330,5 x 0.00","bahanBakar":"Solar","rasioKompresi":"17","sistemPendinginan":"Hopper","setRpm":"1","exhaust":"215","fuel":"120","cooling":"80","rpm":"5","servo":"' . $servo_state . '"}}'
        )
    );

    $headers = array(
        'X-M2M-Origin: 5fe73ec991d0d8bb:4bd2da90a6b504c5',
        'Content-Type: application/json;ty=4',
        'Accept: application/json'
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}


$table = 'config';
$query = $conn->query("SELECT servo FROM $table");
$data = mysqli_fetch_array($query);

if ($_GET["data"] === "inc") {
    $servo = $data['servo'] + 25;
    $response = sendPostRequest($servo);
    echo $response;
} else {
    $servo = $data['servo'] - 25;
    $response = sendPostRequest($servo);
    echo $response;
}


$update = $conn->query("UPDATE $table SET servo='$servo'");

header("location: index.php");

// try {
//   // RETRIEVE DATA
//   $cnt = Antares::getInstance()->get($DEVICE_URI); // TODO: Change this to your device uri
// 	$la = $cnt->getLatestContentInstace();
// 	$obj = json_decode($la->con);
//     if($_POST["data"] === "inc") {
//         $obj->device->rpm = $obj->device->rpm + 1;
//     } else {
//         $obj->device->rpm = $obj->device->rpm - 1;
//     }
//     $jsonData = json_encode($obj);
//     try {
//         $cnt->insertContentInstance($jsonData, 'application/json');
//         $lastCin = $cnt->getLatestContentInstace();
//       } catch (Exception $e) {
//         echo($e->getMessage());
//     }

// } catch (Exception $e) {
//   echo($e->getMessage());
// }
?>