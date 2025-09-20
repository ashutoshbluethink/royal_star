<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "leadblue_leadblue_businessDevelo";
$password = ",Ia0oa.)6Z7=";
$dbname = "leadblue_businessDevelopment";


try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT valid_email, email_status FROM valid_email";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $filename = "valid_emails_" . date('Ymd') . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        $output = fopen('php://output', 'w');

        // Column headers
        fputcsv($output, array('Email', 'Status'));

        // Fetch and write the rows
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }

        fclose($output);
    } else {
        echo "No records found.";
    }

    // Delete data
    $deleteData = "TRUNCATE TABLE valid_email";
    $result = $conn->query($deleteData);
    
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>