<?php

require __DIR__ . "/utils/API.php";

//get  input
$data = file_get_contents('php://input');

$api = new API();

echo json_encode($api->fetchCurrency($data));