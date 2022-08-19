<?php

require_once("../../controllers/waterController.PHP");

$calculation = new WaterController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents("php://input");
    $res = $calculation->getCalculation($data);
    print_r($res);
}

