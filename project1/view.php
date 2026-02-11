<?php
include 'config.php';

$format = $_GET['format'] ?? 'json';

$result = $conn->query("SELECT name, age, city, created_at FROM users");

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

if ($format == "csv") {

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, array_keys($data[0]));

    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);

} else {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}
?>
