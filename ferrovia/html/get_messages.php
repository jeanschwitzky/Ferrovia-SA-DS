<?php
require("phpMQTT.php");

$server = "cd85d77f392340d88bf57f7e27f9d9b9.s1.eu.hivemq.cloud";
$port = 8883;
$topics = [
    'S1/Temperatura',
    'S1/Umidade',
    'S1/Luminosidade',
    'S1/Presença1',
    'S2/Presença2',
    'S2/Presença4',
    'S2/Servo3',
    'S3/Presença3',
    'S3/Servo1',
    'S3/Servo2',
    'Trem/Trem'
];

$client_id = "phpmqtt-" . rand();
$username = "Jeans";
$password = "Bolinha123";
$cafile = __DIR__ . "/cacert.pem";
$messages = [];

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
$mqtt->cafile = $cafile;
if (!$mqtt->connect(true, NULL, $username, $password)) {
    echo json_encode(["error" => "Não foi possível conectar ao broker"]);
    exit;
}

foreach ($topics as $topic) {
    $mqtt->subscribe([
        $topic => [
            "qos" => 0,
            "function" => function ($topic, $msg) use (&$messages) {
                $messages[$topic] = $msg;
            }
        ]
    ], 0);
}

$start = time();
while (time() - $start < 2) {
    $mqtt->proc();
}

$mqtt->close();

echo json_encode($messages);
?>