<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include 'config.php';

$response = [];

try {

    $rawInput = file_get_contents("php://input");
    if (!$rawInput) {
        throw new Exception("No input received.");
    }

    $data = json_decode($rawInput, true);
    if (!isset($data["payload"])) {
        throw new Exception("Invalid request format.");
    }

    $payload = trim($data["payload"]);
    $saveToDB = isset($data["saveToDB"]) ? $data["saveToDB"] : false;

    $timestamp = time();
    $jsonData = [];

    // 🔎 Detect JSON or CSV
    if (substr($payload, 0, 1) === "{" || substr($payload, 0, 1) === "[") {

        $jsonData = json_decode($payload, true);

        if (!$jsonData) {
            throw new Exception("Invalid JSON input.");
        }

        // If single object → convert to array
        if (isset($jsonData["name"])) {
            $jsonData = [$jsonData];
        }

    } else {

        // ===== CSV Input =====
        $lines = array_filter(array_map('trim', explode("\n", $payload)));

        if (count($lines) < 2) {
            throw new Exception("Invalid CSV input.");
        }

        $headers = str_getcsv(array_shift($lines));

        foreach ($lines as $line) {
            $row = str_getcsv($line);
            if (count($row) === count($headers)) {
                $jsonData[] = array_combine($headers, $row);
            }
        }

        if (empty($jsonData)) {
            throw new Exception("CSV parsing failed.");
        }
    }

    // 📁 Save JSON file
    $jsonFile = "storage/json/data_$timestamp.json";
    file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT));
    $response["json_saved"] = $jsonFile;

    // 📁 Save CSV file
    $csvFile = "storage/csv/data_$timestamp.csv";
    $fp = fopen($csvFile, 'w');
    fputcsv($fp, array_keys($jsonData[0]));
    foreach ($jsonData as $row) {
        fputcsv($fp, $row);
    }
    fclose($fp);
    $response["csv_saved"] = $csvFile;

    // 💾 Save to Database
    if ($saveToDB) {

        foreach ($jsonData as $row) {

            if (!isset($row["name"], $row["age"], $row["city"], $row["created_at"])) {
                continue;
            }

            $name = trim($row["name"]);
            $age = (int)$row["age"];
            $city = trim($row["city"]);
            $created_at = trim($row["created_at"]);

            // Generate normalized hash
            $rowString = strtolower($name . "|" . $age . "|" . $city . "|" . $created_at);
            $hash = hash("sha256", $rowString);

            // Check duplicate
            $check = $conn->prepare("SELECT id FROM users WHERE data_hash = ?");
            $check->bind_param("s", $hash);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {

                $response["duplicates"][] = "$name skipped (duplicate)";

            } else {

                $stmt = $conn->prepare(
                    "INSERT INTO users (name, age, city, created_at, data_hash)
                     VALUES (?, ?, ?, ?, ?)"
                );

                $stmt->bind_param("sisss", $name, $age, $city, $created_at, $hash);

                if ($stmt->execute()) {
                    $response["inserted"][] = "$name inserted";
                } else {
                    $response["errors"][] = $stmt->error;
                }
            }
        }
    }

    $response["status"] = "Success";

} catch (Exception $e) {

    $response = [
        "status" => "Error",
        "message" => $e->getMessage()
    ];
}

echo json_encode($response);
exit;
?>
