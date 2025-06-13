<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!isset($data["keys"]) || !is_array($data["keys"])) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Invalid key format"]);
        exit;
    }

    // Save to JSON file
    file_put_contents("apikeys.json", json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "success", "message" => "Keys saved successfully."]);
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Only POST allowed"]);
}
