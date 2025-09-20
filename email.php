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

    $filterWith = [
        'admin', 'customer', 'submissions', 'enquiries', 'support', 'email', 'billing', 
        'sales', 'help', 'office', 'hello', 'order', 'contact', '.org', '.edu', 'qqm.com',
        'webmaster', 'www', '.gov', 'advisor', 'service', 'marketing', 'news', 'feedback',
        'accounting', 'press', 'event', 'reservation', 'communications', 'admissions', 'team',
        'xxx', 'subscriptions', 'inquiries', 'abuse', 'career', 'advertising', 'editor', 'resume',
        'development', 'jobs', 'privacy', 'frontdesk', 'registration', 'proxy', 'mail', 'inquiry',invalid_emails
        'result', 'research', 'cv', 'custserv', 'question', 'quotes'
    ];

    if (isset($_POST['submit'])) {
        $emails = explode(PHP_EOL, $_POST["allemail"]);
        $invalidEmails = [];
        $validEmails = [];

        foreach ($emails as $email) {
            $email = trim($email);  // Trim whitespace from email
            if (empty($email)) {
                continue;
            }
            $isInvalid = false;

            foreach ($filterWith as $value) {
                $value = trim($value);  // Trim whitespace from filter value
                $emailFirstData = explode('@', $email);
                $emailLastData = explode('.', $email);

                if (
                    ($emailFirstData[0] == $value) || 
                    (is_numeric($emailFirstData[0]) !== false) || 
                    (ctype_digit(substr($emailFirstData[0], 0, 1)) !== false) ||
                    (substr($emailFirstData[0], 0, 1) === '.') ||
                    (strpos($email, '..') !== false) ||
                    (strpos($emailLastData[1], $value) !== false)
                    ) {
                    $isInvalid = true;
                    break;  // No need to check further if invalid
                }
            }

            if ($isInvalid) {
                $invalidEmails[] = $email;
            } else {
                $validEmails[] = $email;
            }
        }

        // Prepare batch insert queries
        $sqlInvalid = "INSERT INTO invalid_emails (invalid_email, email_status) VALUES ";
        $sqlValid = "INSERT INTO valid_email (valid_email, email_status) VALUES ";

        $invalidValues = [];
        foreach ($invalidEmails as $email) {
            $invalidValues[] = "('$email', 1)";
        }

        $validValues = [];
        foreach ($validEmails as $email) {
            $validValues[] = "('$email', 1)";
        }

        if (!empty($invalidValues)) {
            $sqlInvalid .= implode(", ", $invalidValues);
            $sqlInvalid .= " ON DUPLICATE KEY UPDATE email_status = VALUES(email_status)";
        }

        if (!empty($validValues)) {
            $sqlValid .= implode(", ", $validValues);
            $sqlValid .= " ON DUPLICATE KEY UPDATE email_status = VALUES(email_status)";
        }

        // Execute batch insert queries in a transaction
        $conn->begin_transaction();
        try {
            if (!empty($invalidValues) && $conn->query($sqlInvalid) !== TRUE) {
                throw new Exception("Error executing invalid emails query: " . $conn->error);
            }

            if (!empty($validValues) && $conn->query($sqlValid) !== TRUE) {
                throw new Exception("Error executing valid emails query: " . $conn->error);
            }

            $conn->commit();
            echo "All emails processed and inserted/updated successfully.<br>";
            ?>
            <p><a href="/emailform.php">Go Back</a></p>
            <?php
        } catch (Exception $e) {
            $conn->rollback();
            echo "Transaction failed: " . $e->getMessage() . "<br>";
        }
    }

    // Remove duplicates from the database after inserting emails
    $removeDuplicatesQuery = "
        DELETE n1 FROM invalid_emails n1
        INNER JOIN invalid_emails n2 
        WHERE 
            n1.invalid_emails = n2.invalid_emails 
            AND n1.id > n2.id;

        DELETE n1 FROM valid_email n1
        INNER JOIN valid_email n2 
        WHERE 
            n1.valid_email = n2.valid_email 
            AND n1.id > n2.id;
    ";

    $conn->begin_transaction();
    try {
        if ($conn->multi_query($removeDuplicatesQuery) === TRUE) {
            do {
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->more_results() && $conn->next_result());
        } else {
            throw new Exception("Error removing duplicates: " . $conn->error);
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }

    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>