public function subscribeToEvents()
{
    error_log("✅ CustomAlerts module subscribed to events");

    // Try multiple possible events
    $this->dispatcher->addListener('patient.load.after', [$this, 'showAlert']);
    $this->dispatcher->addListener('patient.summary.after', [$this, 'showAlert']);
}

public function showAlert($event)
{
    error_log("✅ CustomAlerts showAlert triggered");

    $pid = method_exists($event, 'getPid') ? $event->getPid() : null;
    error_log("Patient ID: " . print_r($pid, true));

    if (!$pid) {
        return;
    }

    $sql = "SELECT fname, lname, DOB FROM patient_data WHERE pid = ?";
    $res = sqlQuery($sql, [$pid]);

    if ($res) {
        error_log("✅ Patient found: " . $res['fname'] . " " . $res['lname']);
        $name = $res['fname'] . ' ' . $res['lname'];
        $dob  = $res['DOB'];
        $age  = (int)((time() - strtotime($dob)) / 31556926);

        if ($age > 50) {
            error_log("⚠️ Triggering alert for $name age $age");
            require(__DIR__ . '/../views/alert.php');
        }
    }
}
