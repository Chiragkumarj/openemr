<?php

use OpenEMR\Core\Header;

/**
 * Function triggered on patient summary header load
 */
function custom_alerts_patient_summary_header($pid)
{
    error_log("✅ CustomAlerts showAlert triggered via hook, PID: " . $pid);

    $sql = "SELECT fname, lname, DOB FROM patient_data WHERE pid = ?";
    $res = sqlQuery($sql, [$pid]);

    if (!$res) return;

    $name = $res['fname'] . ' ' . $res['lname'];
    $dob  = $res['DOB'];
    $age  = (int)((time() - strtotime($dob)) / 31556926);

    if ($age > 50) {
        error_log("⚠️ Triggering alert for $name, age $age");
        require(__DIR__ . "/views/alert.php");
    }
}

// Register legacy hook
$hook = [
    'patient_summary_header' => 'custom_alerts_patient_summary_header'
];
