<?php
$data = json_decode(file_get_contents("php://input"), true);
$text = $data["text"];

$hash = hash("sha256", $text);

echo json_encode(["hash" => $hash]);
?>
