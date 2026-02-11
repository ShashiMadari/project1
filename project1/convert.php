<?php
$data = json_decode(file_get_contents("php://input"), true);

$filename = "storage/csv/data_" . time() . ".csv";
$file = fopen($filename, "w");

fputcsv($file, array_keys($data[0]));

foreach ($data as $row) {
    fputcsv($file, $row);
}

fclose($file);

echo json_encode(["message" => "Converted to CSV", "file" => $filename]);
?>
