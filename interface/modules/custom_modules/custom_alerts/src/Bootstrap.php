<?php

namespace OpenEMR\Modules\CustomAlerts;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Bootstrap
{
    protected $dispatcher;
    protected $kernel;

    public function __construct(EventDispatcherInterface $dispatcher, $kernel)
    {
        $this->dispatcher = $dispatcher;
        $this->kernel = $kernel;
    }

    public function subscribeToEvents()
    {
        // Hook into patient summary load
        $this->dispatcher->addListener('patient.summary.load', [$this, 'showAlert']);
    }

    public function showAlert($event)
    {
        $pid = $event->getPid();

        $sql = "SELECT fname, lname, DOB FROM patient_data WHERE pid = ?";
        $res = sqlQuery($sql, [$pid]);

        if ($res) {
            $name = $res['fname'] . ' ' . $res['lname'];
            $dob  = $res['DOB'];
            $age  = (int)((time() - strtotime($dob)) / 31556926);

            if ($age > 50) {
                require(__DIR__ . '/../views/alert.php');
            }
        }
    }
}
