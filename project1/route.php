<?php
$data = json_decode(file_get_contents("php://input"), true);
$format = $data["format"];
$payload = $data["payload"];

if ($format == "json") {
    $filename = "storage/json/app_" . time() . ".json";
    file_put_contents($filename, json_encode($payload, JSON_PRETTY_PRINT));
    echo json_encode(["routed_to" => "JSON App", "file" => $filename]);

} elseif ($format == "csv") {
    $filename = "storage/csv/app_" . time() . ".csv";
    $file = fopen($filename, "w");

    fputcsv($file, array_keys($payload[0]));
    foreach ($payload as $row) {
        fputcsv($file, $row);
    }
    fclose($file);

    echo json_encode(["routed_to" => "CSV App", "file" => $filename]);

} else {
    echo json_encode(["error" => "Invalid format"]);
}
?>
