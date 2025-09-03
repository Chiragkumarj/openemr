<?php

use OpenEMR\Core\Header;

function custom_alerts_patient_summary($pid)
{
    // Example: Simple age-based alert
    $sql = "SELECT fname, lname, DOB FROM patient_data WHERE pid = ?";
    $res = sqlQuery($sql, [$pid]);

    if (!$res) return;

    $name = $res['fname'] . ' ' . $res['lname'];
    $dob  = $res['DOB'];
    $age  = (int)((time() - strtotime($dob)) / 31556926);

    if ($age > 50) {
        require(__DIR__ . "/views/alert.php");
    }
}

// Register hook
$hook = [
    'patient_summary' => 'custom_alerts_patient_summary'
];
