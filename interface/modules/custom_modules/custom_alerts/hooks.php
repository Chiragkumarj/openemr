<?php

use OpenEMR\Core\Header;

function custom_alerts_patient_summary($pid)
{
    error_log("✅ CustomAlerts showAlert triggered via hook, PID: " . $pid);

    // Fetch patient info
    $sql = "SELECT fname, lname, DOB FROM patient_data WHERE pid = ?";
    $res = sqlQuery($sql, [$pid]);

    if (!$res) return;

    $name = $res['fname'] . ' ' . $res['lname'];
    $dob  = $res['DOB'];
    $age  = (int)((time() - strtotime($dob)) / 31556926);

    if ($age > 50) {
        error_log("⚠️ Triggering alert for $name age $age");
        require(__DIR__ . "/views/alert.php");
    }
}

// Register legacy hook
$hook = [
    'patient_summary' => 'custom_alerts_patient_summary'
];
